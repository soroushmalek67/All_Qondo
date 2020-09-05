<?php namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Mail;
use Carbon\Carbon;
use App\Models\ModelMessages;
use App\Http\Requests\Users\RequestMessage;


class Messages extends Controller {

    protected $viewData = array();
    protected $userid;
    
    public function __construct() {
        $this->viewData['userType'] = Auth::userType();
        $this->userid = Auth::id();

        $this->viewData['dashboardUser'] = "Supplier";
        $this->viewData['userPostType'] = "Quote";
        $this->viewData['userPostResponser'] = "Buyer";

        if ($this->viewData['userType'] == 1) {
            $this->viewData['dashboardUser'] = "Buyer";
            $this->viewData['userPostType'] = "Request";
            $this->viewData['userPostResponser'] = "Supplier";
        }
    }
    
    public function index() {
        $data = $this->viewData;
        $data['userid'] = $this->userid;
        $data['metas'] = get_page_meta_array('Messages');
        
        if ($this->viewData['userType'] == 1) {
            DB::table('messages as m')->leftJoin('quotes as q', 'q.id', '=', 'm.quote_id')->leftJoin('request_service as rs', 'rs.id', '=', 'q.request_id')
                            ->where('rs.buyer_id', Auth::id())->where('m.sender_id', '!=', $this->userid)->where('m.notification_status', 1)
                            ->update(['m.notification_status' => 0]);
        } else {
            DB::table('messages as m')->leftJoin('quotes as q', 'q.id', '=', 'm.quote_id')->leftJoin('request_service as rs', 'rs.id', '=', 'q.request_id')
                            ->where('q.supplier_id', Auth::id())->where('m.sender_id', '!=', $this->userid)->where('m.notification_status', 1)
                            ->update(['m.notification_status' => 0]);
        }
        
        $data['messagesList'] = DB::table(DB::raw('(SELECT * FROM messages ORDER BY id DESC) as m'))->leftJoin('quotes as q', 'q.id', '=', 'm.quote_id')
                                ->leftJoin('request_service as rs', 'rs.id', '=', 'q.request_id')->leftJoin('users as u', 'u.id', '=', 'm.sender_id')
                                ->select('m.*', 'u.first_name', 'u.last_name', 'rs.title', 'u.anonymous')->where('q.supplier_id', $this->userid)
                                ->orWhere('rs.buyer_id', $this->userid)->groupBy('m.quote_id')->orderBy('m.id', 'DESC')
                                ->get();
        
        return view('users.message_list', $data);
    }

    public function MessagesDetail($id) {
        $data = $this->viewData;
        $data['userid'] = $this->userid;
        $data['metas'] = get_page_meta_array('Message');
        
        DB::table('messages')->where('quote_id', $id)->where('sender_id', '!=', $this->userid)->update(['status' => 1]);
        
        $data['messages'] = ModelMessages::leftJoin('users as u', 'u.id', '=', 'messages.sender_id')
                            ->select('messages.*', 'u.first_name', 'u.last_name', 'u.business_name', 'u.anonymous')
                            ->where('quote_id', $id)->orderBy('messages.id', 'DESC')->get();
        $data['requestDetails'] = DB::table('request_service as rs')->leftJoin('quotes as q', 'q.request_id', '=', 'rs.id')
                            ->select('rs.title')->where('q.id', $id)->first();
        
        $data['quoteid'] = $id;
        
        return view('users.messages_detail', $data);
    }
    
    public function publicMessagesDetail($id) {
        $data = $this->viewData;
        $data['userid'] = $this->userid;
        $data['metas'] = get_page_meta_array('Message');
        
        DB::table('messages')->where('quote_id', $id)->where('sender_id', '!=', $this->userid)->update(['status' => 1]);
       
        $data['requestDetails'] = DB::table('request_service as rs')
                            ->select('rs.title', 'rs.id as requestId')->where('rs.id', $id)->first();
        
        $data['suppliers'] = DB::table('quotes_invitation as qi')
                            ->leftjoin('users','users.id','=','qi.supplier_id')
                            
                            ->select('users.id as user_id','users.business_name')
                            ->where('qi.request_id',$id)
                            ->get();
        $data['quoteid'] = $id;
        return view('users.publicmessage', $data);
    }
    
     public function MessageCreate(RequestMessage $request) {
        $quoteid = $request->get('quoteid');
        $quoteidarray="";
        
        if($quoteid==null){
            $quoteidarray = DB::table('quotes')
                          ->where('request_id' , $request->get('request_id'))
                          ->get();
        }
        $users = DB::table('users as u')->leftJoin('quotes as q', 'q.supplier_id', '=', 'u.id')
                ->leftJoin('request_service as rs', 'rs.id', '=', 'q.request_id')->leftJoin('users as ub', 'ub.id', '=', 'rs.buyer_id')
                ->leftJoin('emails_subscription as es', 'u.id', '=', 'es.userid')
                ->leftJoin('emails_subscription as esb', 'ub.id', '=', 'esb.userid')
                ->select('u.id as supplierID', 'u.first_name as supplierFirstName', 'u.last_name as supplierLastName', 
                            'u.email as supplierEmail', 'u.approval_email as a_email','es.message_notification as supplierNotification', 'ub.id as buyerID', 
                            'ub.first_name as buyerFirstName', 'ub.last_name as buyerLastName', 'ub.email as buyerEmail', 
                            'esb.message_notification as buyerNotification')
                ->where('q.id', $quoteid)->first();
        
        if($quoteid == null){
            foreach ($quoteidarray as $quote){
                 $messageid = ModelMessages::create(['quote_id' => $quote->id, 'sender_id' => $this->userid, 'message' => nl2br($request->get('message')), 
                                                     'created_at' => Carbon::now()]);
            }
        } else {
            $messageid = ModelMessages::create(['quote_id' => $quoteid, 'sender_id' => $this->userid, 'message' => nl2br($request->get('message')), 
                                                'created_at' => Carbon::now()]);
        }
        
        if ($request->file('file') != null) {
            $fileName = saveOrReplaceFile("img/messages", $request->file('file'), "", $messageid['id'], $messageid['created_at']);
            $quoteDetails = ModelMessages::find($messageid['id']);
            $quoteDetails->file = $fileName;
            $quoteDetails->save();
        }
        
        $receiverData = [];
        if ($users->supplierID == $this->userid) {
            $receiverData = ['firstName' => $users->buyerFirstName, 'lastName' => $users->buyerLastName, 'email' => $users->buyerEmail, 
                                'notification' => $users->buyerNotification, 'sernderFirstName' => $users->supplierFirstName, 
                                'sernderLastName' => $users->supplierLastName, 'apr_email'=>$users->a_email];
        } else {
            $receiverData = ['firstName' => $users->supplierFirstName, 'lastName' => $users->supplierLastName, 'email' => $users->supplierEmail, 
                                'notification' => $users->supplierNotification, 'sernderFirstName' => $users->buyerFirstName, 
                                'sernderLastName' => $users->buyerLastName , 'apr_email'=>$users->a_email];
        }
        $receiverEmail = $receiverData['email'];
        $receiverAEmail = $receiverData['apr_email'];
        
        if ($receiverData['notification']) {
            $send_messageNotification = DB::table('notification')
                                        ->where('notificationName','send_message')
                                        ->first();    
            $buyer  = strtr($send_messageNotification->content, ["@firstname" => $users->buyerFirstName , "@lastname" =>$users->buyerLastName ,
                                    "@sernderFirstName" =>$users->supplierFirstName, "@sernderLastName" =>substr($users->supplierLastName, 0, 1),
                                        '@messageurl'=>url('messages'), '@click_here'=>url('unsubscribe')]);
            $data = ['emailbody' => $buyer];
            
            Mail::send('emails.message_received', $data, function($message) use ($receiverEmail,$receiverAEmail){
                $message->to($receiverEmail)
                    ->subject('Message Received');
                if($receiverAEmail != null)
                    $message->cc($receiverAEmail);
                $message->from(SENDER_EMAIL, SENDER_NAME);
            });
        }
        
        return redirect('messages')->with('message', 'Message Sent Successfully!');
    }
}