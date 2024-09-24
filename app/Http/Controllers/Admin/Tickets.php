<?php

namespace App\Http\Controllers\Admin;

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
            'tickets'  =>  Ticket::orderBy('id','desc')->orderBy('status','desc')->get(),
            'users'     => User::where('id','!=',$user->id)->where('status',1)->get()
        ];

        return view('admin.tickets',$dataView);
    }

    public function ticketDetail($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $ticket = Ticket::where('reference',$id)->first();
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

        return view('admin.ticket_detail',$dataView);
    }

    public function addTicket(Request $request)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $validator = Validator::make($request->all(),[
            'subject'=>['required','string','max:200'],
            'content'=>['required'],
            'user'=>['required']
        ])->stopOnFirstFailure();

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();
        $ref = $this->generateId('tickets','reference');
        $ticketData = [
            'user'=>$input['user'],
            'subject'=>$input['subject'],
            'content'=>$input['content'],
            'status'=>2,
            'reference'=>$ref
        ];
        $ticket = Ticket::create($ticketData);
        if (!empty($ticket)){
            //send mail to user
            $investor = User::where('id',$input['user'])->first();
            if (!empty($investor)){
                $adminMessage = "
                    A new support ticket has been created for you with reference <b>".$ref."</b>
                ";
                //SendInvestmentNotification::dispatch($admin,$adminMessage,'New Withdrawal Request');
                $investor->notify(new InvestmentMail($investor,$adminMessage,'Support Ticket:'.$input['subject']));
            }
            return back()->with('success','Ticket created.');
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

        $ticket = Ticket::where('id',$input['id'])->first();
        if (empty($ticket)){
            return back()->with('error','Invalid ticket selected');
        }

        $dataResponse = [
            'ticketId'=>$input['id'],
            'user'=>$user->id,
            'response'=>$input['content'],
            'responseType'=>1
        ];
        $response = TicketResponse::create($dataResponse);
        if (!empty($response)){
            $ticket->status = 3;
            $ticket->save();

            //send mail to admin
            $investor = User::where('id',$ticket->user)->first();
            if (!empty($investor)){
                $adminMessage = "
                    A new response has been added to your ticket with
                    reference <b>".$ticket->reference."</b>
                ";
                //SendInvestmentNotification::dispatch($admin,$adminMessage,'New Withdrawal Request');
                $investor->notify(new InvestmentMail($investor,$adminMessage,'Ticket Response.'));
            }
            return back()->with('success','Response sent');
        }
        return  back()->with('error','Something went wrong');
    }

    public function closeTicket($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $ticket = Ticket::where('reference',$id)->first();
        if (empty($ticket)){
            return back()->with('error','Invalid ticket selected');
        }
        if ($ticket->status==1){
            return back()->with('error','Ticket already closed.');
        }
        $ticket->status = 1;
        $ticket->save();

        //send mail to investor
        $investor = User::where('id',$ticket->user)->first();
        if (!empty($investor)){
            $adminMessage = "
                    Your ticket with reference <b>".$ticket->reference."</b> has been marked as answered, and hence closed.
                    To reopen, just send a reply to the ticket and we will attend to you soon.
                ";
            //SendInvestmentNotification::dispatch($admin,$adminMessage,'New Withdrawal Request');
            $investor->notify(new InvestmentMail($investor,$adminMessage,'Ticket Closed..'));
        }

        return back()->with('success','Ticket Closed');
    }
}
