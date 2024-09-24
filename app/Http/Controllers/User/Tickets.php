<?php

namespace App\Http\Controllers\User;

use App\Custom\GenerateUnique;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\User;
use App\Notifications\InvestmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Tickets extends Controller
{
    use GenerateUnique;
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Support Tickets',
            'user'     =>  $user,
            'web'      =>  $web,
            'tickets'  =>  Ticket::where('user',$user->id)->orderBy('id','desc')->orderBy('status','desc')->get()
        ];

        return view('user.tickets',$dataView);
    }

    public function ticketDetail($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $ticket = Ticket::where('user',$user->id)->where('reference',$id)->first();
        if (empty($ticket)){
            return back()->with('error','Invalid ticket selected');
        }
        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Ticket Details',
            'user'     =>  $user,
            'web'      =>  $web,
            'ticket'  =>  $ticket,
            'responses' =>TicketResponse::where('ticketId',$ticket->id)->get()
        ];

        return view('user.ticket_detail',$dataView);
    }

    public function addTicket(Request $request)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $validator = Validator::make($request->all(),[
            'subject'=>['required','string','max:200'],
            'content'=>['required']
        ])->stopOnFirstFailure();

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();
        $ref = $this->generateId('tickets','reference');
        $ticketData = [
            'user'=>$user->id,
            'subject'=>$input['subject'],
            'content'=>$input['content'],
            'status'=>2,
            'reference'=>$ref
        ];
        $ticket = Ticket::create($ticketData);
        if (!empty($ticket)){
            //send mail to admin
            $admin = User::where('is_admin',1)->first();
            if (!empty($admin)){
                $adminMessage = "
                    A new support ticket has been submitted by the investor <b>".$user->name."</b> with
                    reference <b>".$ref."</b>
                ";
                //SendInvestmentNotification::dispatch($admin,$adminMessage,'New Withdrawal Request');
                $admin->notify(new InvestmentMail($admin,$adminMessage,'New Support Request'));
            }
            return back()->with('success','Ticket created. You will receive a feedback soon.');
        }
        return back()->with('error','Something went wrong');
    }

    public function addReply(Request $request)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $validator = Validator::make($request->all(),[
            'id'=>['required','numeric'],
            'content'=>['required']
        ])->stopOnFirstFailure();

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $ticket = Ticket::where('user',$user->id)->where('id',$input['id'])->first();
        if (empty($ticket)){
            return back()->with('error','Invalid ticket selected');
        }

        $dataResponse = [
            'ticketId'=>$input['id'],
            'user'=>$user->id,
            'response'=>$input['content'],
            'responseType'=>2
        ];
        $response = TicketResponse::create($dataResponse);
        if (!empty($response)){
            $ticket->status = 2;
            $ticket->save();
            //send mail to admin
            $admin = User::where('is_admin',1)->first();
            if (!empty($admin)){
                $adminMessage = "
                    A new response has been received to the ticket by the investor <b>".$user->name."</b> with
                    reference <b>".$ticket->reference."</b>
                ";
                //SendInvestmentNotification::dispatch($admin,$adminMessage,'New Withdrawal Request');
                $admin->notify(new InvestmentMail($admin,$adminMessage,'New Support Response'));
            }
            return back()->with('success','Response sent. You will receive a feedback soon.');
        }
        return  back()->with('error','Something went wrong');
    }
}
