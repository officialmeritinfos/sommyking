<?php

namespace App\Http\Controllers\User;

use App\Custom\GenerateUnique;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Coin;
use App\Models\GeneralSetting;
use App\Models\Staking;
use App\Models\StakingPackage;
use App\Models\SystemWallet;
use App\Models\User;
use App\Notifications\InvestmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Investments extends Controller
{
    use GenerateUnique;
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'investments'=>Staking::where('user',$user->id)->get(),
            'pageName'=>'Investment Lists',
            'siteName'=>$web->name
        ];

        return view('user.investments',$dataView);
    }

    public function newInvestment()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'New Investment',
            'siteName'=>$web->name,
            'packages'=>StakingPackage::where('status',1)->where('isBonus','!=',1)->get(),
            'bonusPackages'=>StakingPackage::where('status',1)->where('isBonus',1)->get(),
        ];

        return view('user.new_investment',$dataView);
    }
    public function newInvestmentId($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'Preview New Investment',
            'siteName'=>$web->name,
            'package'=>StakingPackage::where('status',1)->where('id',$id)->first(),
            'balances'=>Balance::where('user',$user->id)->get(),
            'assets'=>SystemWallet::where('status',1)->get()
        ];

        return view('user.new_investment_preview',$dataView);
    }

    public function processInvestment(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'amount'=>['required','numeric'],
            'account'=>['required','numeric'],
            'package'=>['required','numeric'],
            'asset'=>['required','string','exists:system_wallets,asset'],
            'sector'=>['required','string'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        //check if the package exists

        $packageExists = StakingPackage::where('id',$input['package'])->first();

        if (empty($packageExists)){
            return back()->with('error','Selected Package is invalid');
        }

        if ($packageExists->isBonus==1 && $user->hasBonus!=1){
            return back()->with('error','You are not eligible for this package, please contact support.');
        }

        $coin = SystemWallet::where('asset',$input['asset'])->first();

        //check if amount matches
        if ($packageExists->unlimited !=1){
            if ($packageExists->maxAmount < $input['amount']){
                return back()->with('error','Investment amount cannot be greater than maximum amount');
            }
        }
        if ($packageExists->minAmount > $input['amount']){
            return back()->with('error','Investment amount cannot be less than minimum amount');
        }

        //check if the user has the amount in balance
        switch ($input['account']){
            case 1:
                $balance = $user->balance;
                $source = 'New Deposit';
                $newBalance = [
                    'balance'=>$balance
                ];
                $status = 2;
                break;
            default:
                $balance = $user->profit;
                $source = 'profit';
                $newBalance = [
                    'profit'=>$balance- $input['amount']
                ];
                $status = 4;
                break;
        }

        if ($balance < $input['amount'] && $input['account']!=1){
            return back()->with('error','Insufficient balance in selected account.');
        }
        //do calculations for the investment
        $roi = $packageExists->Roi;
        $profitPerReturn = $input['amount']*($roi/100);
        $nextReturn = strtotime($packageExists->returnType,time());
        $ref =$this->generateId('stakings','stakeRef');

        $dataInvestment = [
            'user'=>$user->id,'amount'=>$input['amount'],'Roi'=>$roi,'stakeRef'=>$ref,
            'source'=>strtolower($source),'profitPerReturn'=>$profitPerReturn,'currentProfit'=>0,
            'nextReturn'=>$nextReturn,'currentReturn'=>0,'returnType'=>$packageExists->returnType,
            'numberOfReturn'=>$packageExists->numberOfReturn,'status'=>$status,
            'Duration'=>$packageExists->Duration,
            'packageId'=>$packageExists->id,'wallet'=>$coin->address,'type'=>$input['account'],
            'network'=>$coin->network,'asset'=>$input['asset'],'sector'=>$input['sector']
        ];

        $investment = Staking::create($dataInvestment);
        if (!empty($investment)){
            User::where('id',$user->id)->update($newBalance);
            //send notification
            //check if admin exists
            $admin = User::where('is_admin',1)->first();
            if ($input['account']==1){

                $userMessage = "
                    Your new investment of $<b>".$input['amount']." </b>
                    has been received and pending payment. Your Investment reference Id is <b>".$ref."</b>.<br/>
                    Make your deposit of $<b>".$input['amount']." </b> equivalence of <b>".$input['asset']."</b> to
                    <b>".$coin->address."</b>. Network must be <b>".$coin->network."</b> to avoid lose of funds.
                ";
                $title = 'Pending Deposit';
            }else{

                $userMessage = "
                    Your new investment of $<b>".$input['amount']." </b>
                    has been received and started. Your Investment reference Id is <b>".$ref."</b>
                ";
                $title = 'Investment Initiation';
            }
            //send mail to user
            //SendInvestmentNotification::dispatch($user,$userMessage,'Investment Initiation');
            $user->notify(new InvestmentMail($user,$userMessage,$title));
            //send mail to Admin
            if (!empty($admin)){
                if ($input['account']==1) {
                    $adminMessage = "
                        A new investment of $<b>" . $input['amount'] . "</b>
                        has been started by the investor <b>" . $user->name . "</b> with reference <b>" . $ref . "</b>.
                        And is pending payment.
                    ";
                }else{
                    $adminMessage = "
                        A new investment of $<b>" . $input['amount'] . "</b>
                        has been started by the investor <b>" . $user->name . "</b> with reference <b>" . $ref . "</b>
                    ";
                }
                //SendInvestmentNotification::dispatch($admin,$adminMessage,'New Investment Initiation');
                $admin->notify(new InvestmentMail($admin,$adminMessage,'New Investment Initiation'));
            }
            return redirect()->route('invest_detail',['id'=>$investment->id])->with('success','Investment initiated.');
        }
        return back()->with('error','Something went wrong');
    }

    public function investmentDetails($id)
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        $investment = Staking::where('user',$user->id)->findOrFail($id);
        $dataView = [
            'user'=>$user,
            'web'=>$web,
            'pageName'=>'Investment Detail',
            'siteName'=>$web->name,
            'investment'=>$investment,
        ];
        return view('user.investment_detail',$dataView);
    }

    public function cancel($id)
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        $investment = Staking::where('user',$user->id)->where('id',$id)->first();

        if (empty($investment)){
            return back()->with('error','Investment not found');
        }
        if ($investment->status ==1){
            return back()->with('error','Investment already completed.');
        }

        if ($investment->status ==3){
            return back()->with('error','Investment already cancelled.');
        }

        $data=['status'=>3];

        switch ($investment->source){
            case 'balance':
                $balance = $user->balance+$investment->amount;
                $newBalance = ['balance'=>$balance];
                break;
            default:
                $balance = $user->profit+$investment->amount;
                $newBalance = ['profit'=>$balance];
                break;
        }
        $update=Staking::where('id',$investment->id)->update($data);

        if ($update){

            User::where('id',$user->id)->update($newBalance);

            return back()->with('success','Investment cancelled');
        }

        return back()->with('error','Something went wrong');
    }
}
