<?php

namespace App\Http\Controllers\Admin;

use App\Custom\GenerateUnique;
use App\Custom\Regular;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\Staking;
use App\Models\SystemAccount;
use App\Models\SystemWallet;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Notifications\InvestmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Investors extends Controller
{
    use GenerateUnique;

    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Investors',
            'user'     =>  $user,
            'web'=>$web,
            'investors'=>User::get()
        ];

        return view('admin.investors',$dataView);
    }

    public function details($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Investor Details',
            'user'     =>  $user,
            'web'=>$web,
            'investor'=>User::where('id',$id)->first(),
            'wallets'=>Wallet::where('user',$id)->get(),
            'deposits'=>Staking::where('user',$id)->paginate(10),
            'coins'=>SystemWallet::where('status',1)->get()
        ];

        return view('admin.investor_detail',$dataView);
    }

    public function activateTwoWay($id)
    {
        $data =[
            'twoWay'=>1
        ];
        User::where('id',$id)->update($data);

        return back()->with('success','Successful');
    }
    public function deactivateTwoWay($id)
    {
        $data =[
            'twoWay'=>2
        ];
        User::where('id',$id)->update($data);

        return back()->with('success','Successful');
    }
    public function activateBonusPackage($id)
    {
        $data =[
            'canCompound'=>1
        ];
        User::where('id',$id)->update($data);

        return back()->with('success','Successful');
    }
    public function deactivateBonusPackage($id)
    {
        $data =[
            'canCompound'=>2
        ];
        User::where('id',$id)->update($data);

        return back()->with('success','Successful');
    }
    public function verifyEmail($id)
    {
        $data =[
            'emailVerified'=>1
        ];
        User::where('id',$id)->update($data);

        return back()->with('success','Successful');
    }
    public function unVerifyEmail($id)
    {
        $data =[
            'emailVerified'=>2
        ];
        User::where('id',$id)->update($data);

        return back()->with('success','Successful');
    }
    public function activateUser($id)
    {
        $data =[
            'status'=>1
        ];
        User::where('id',$id)->update($data);

        return back()->with('success','Successful');
    }
    public function deactivateUser($id)
    {
        $data =[
            'status'=>2
        ];
        User::where('id',$id)->update($data);

        return back()->with('success','Successful');
    }

    public function addFund(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'id'=>['required','numeric'],
            'amount'=>['required','numeric'],
            'asset'=>['required','string'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $investor = User::where('id',$input['id'])->first();

        $data = [
            'balance'=>$investor->balance+$input['amount']
        ];

        Deposit::create([
            'user'=>$investor->id,
            'amount'=>$input['amount'],
            'asset'=>$input['asset'],
            'fiat'=>$input['amount']
        ]);

        $update = User::where('id',$input['id'])->update($data);
        if ($update){
            //send mail to investor
            $userMessage = "
                Your deposit of $<b>" . $input['amount'] . "</b> has been received and credited to your account.
            ";
            //SendInvestmentNotification::dispatch($investor, $userMessage, 'Balance Topup');
            $investor->notify(new InvestmentMail($investor, $userMessage, 'Account Credit Notification'));
        }
        return back()->with('success','Balance added');
    }
    public function addProfit(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'id'=>['required','numeric'],
            'amount'=>['required','numeric'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $investor = User::where('id',$input['id'])->first();

        $data = [
            'profit'=>$investor->profit+$input['amount']
        ];

        $update = User::where('id',$input['id'])->update($data);
        if ($update){
            //send mail to investor
            $userMessage = "
                Your Profit balance has been credited with $<b>" . $input['amount'] . " .
            ";
            //SendInvestmentNotification::dispatch($investor, $userMessage, 'Profit Topup');
            $investor->notify(new InvestmentMail($investor, $userMessage, 'Profit Topup'));
        }
        return back()->with('success','Profit added');
    }
    public function addRef(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'id'=>['required','numeric'],
            'amount'=>['required','numeric'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $investor = User::where('id',$input['id'])->first();

        $data = [
            'referral'=>$investor->referral+$input['amount']
        ];

        $update = User::where('id',$input['id'])->update($data);
        if ($update){
            //send mail to investor
            $userMessage = "
                Your Referral balance has been credited with $<b>" . $input['amount'] . " .
            ";
            //SendInvestmentNotification::dispatch($investor, $userMessage, 'Referral Topup');
            $investor->notify(new InvestmentMail($investor, $userMessage, 'Referral Topup'));
        }
        return back()->with('success','Referral Balance added');
    }
    public function addWith(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'id'=>['required','numeric'],
            'amount'=>['required','numeric'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $investor = User::where('id',$input['id'])->first();

        $data = [
            'withdrawal'=>$investor->withdrawal+$input['amount']
        ];

        $update = User::where('id',$input['id'])->update($data);
        if ($update){
            //send mail to investor
            $userMessage = "
                Your Withdrawal request of $<b>" . $input['amount'] . "</b> has been processed
                and sent to your wallet Address. Your transaction hash is <b>".Str::random(200)."</b>
            ";
            //SendInvestmentNotification::dispatch($investor, $userMessage, 'Withdrawal Approved');
            $investor->notify(new InvestmentMail($investor, $userMessage, 'Withdrawal Approved'));
        }
        return back()->with('success','Withdrawal added');
    }

    public function subFund(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'id'=>['required','numeric'],
            'amount'=>['required','numeric'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $investor = User::where('id',$input['id'])->first();

        $data = [
            'balance'=>$investor->balance-$input['amount']
        ];

        $update = User::where('id',$input['id'])->update($data);

        return back()->with('success','Balance subtracted');
    }
    public function subProfit(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'id'=>['required','numeric'],
            'amount'=>['required','numeric'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $investor = User::where('id',$input['id'])->first();

        $data = [
            'profit'=>$investor->profit-$input['amount']
        ];

        $update = User::where('id',$input['id'])->update($data);

        return back()->with('success','Profit subtracted');
    }
    public function subRef(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'id'=>['required','numeric'],
            'amount'=>['required','numeric'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $investor = User::where('id',$input['id'])->first();

        $data = [
            'referral'=>$investor->referral-$input['amount']
        ];

        $update = User::where('id',$input['id'])->update($data);

        return back()->with('success','Referral Balance subtracted');
    }
    public function subWith(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'id'=>['required','numeric'],
            'amount'=>['required','numeric'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $investor = User::where('id',$input['id'])->first();

        $data = [
            'withdrawal'=>$investor->withdrawal-$input['amount']
        ];

        $update = User::where('id',$input['id'])->update($data);

        return back()->with('success','Withdrawal subtracted');
    }

    public function doWithdrawal(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'amount'=>['bail','required','numeric'],
            'asset'=>['bail','required','numeric'],
            'address'=>['bail','required','string'],
            'pin'=>['bail','required']
        ]);
        if ($validator->fails()){
            return back()->with('error',$validator->errors());
        }

        $input = $validator->validated();

        $amount = $input['amount'];

        //check user wallet
        $wallet = Wallet::where('id',$input['asset'])->first();


        $coin = $wallet->asset;

        $systemAccount = SystemAccount::where('asset',strtoupper($wallet->asset))->first();
        //check for pin
        $hashed = Hash::check($input['pin'],$user->password);
        if (!$hashed){
            return back()->with('error','Unauthorized action.');
        }

        //check for balance
        if ($wallet->availableBalance < $input['amount']){
            return back()->with('error','Insufficient balance in '.$wallet->asset.' account.');
        }
        $ref = $this->generateId('withdrawals','reference',10);
        $rates = new Regular();
        $rate = $rates->getCryptoExchange($input['asset']);

        $fiatAmount = $amount*$rate;

        $dataBalance = [
            'availableBalance'=>$wallet->availableBalance - $input['amount']
        ];

        $data=[
            'user'=>$user->id,'reference'=>$ref,'fiatAmount'=>$fiatAmount,'asset'=>$wallet->asset,
            'addressTo'=>$input['address'],'accountId'=>$systemAccount->accountId,
            'amount'=>$amount,'status'=>4,'isSystem'=>1,'derivationKey'=>$wallet->derivationKey
        ];
        $withdrawal = Withdrawal::create($data);
        if (!empty($withdrawal)){
            Wallet::where('id',$wallet->id)->update($dataBalance);

            $userMessage = "A new system withdrawal of <b>".$amount.$coin."</b> has been authorized on your account and sent
             to the wallet address <b>".$input['address']."</b>";
            //send mail to user
            //SendInvestmentNotification::dispatch($user,$userMessage,'New Withdrawal');
            $user->notify(new InvestmentMail($user,$userMessage,'New System Withdrawal'));

            return back()->with('success','Withdrawal processing.');
        }
    }

    public function loginToUser($id)
    {
        $investor = User::where('id',$id)->first();

        Auth::login($investor);

        return to_route('user.dashboard');
    }
}
