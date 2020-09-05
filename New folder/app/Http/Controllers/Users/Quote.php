<?php namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Mail;
use App\User;
use App\Http\Requests\Users\RequestSendQuote;
use App\Models\ModelQuotes;
use App\ModelRequestService;


class Quote extends Controller {

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
    
    public function index($requestid) {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Send Quote');
        $data['requestid'] = $requestid;
        return view('users.send_quote', $data);
    }
    
    public function Save(RequestSendQuote $request) {
        $subscriptions = DB::table('emails_subscription')->where('userid', $this->userid)->first();
        
        $userObj = User::find($this->userid);
        $userDetails = $userObj->toArray();
        //print_r($userDetails);exit();
        if ($userDetails['bids'] > 0 ) {
            if (!empty($userDetails['membership'])) {
                $expiryDateObj = DB::table('transactions')->select('expires_at','id')->where('userid', $this->userid)
                                        ->where( function ($query){
                                            
                                            $query->where('package', 'Enterprise')
                                                    ->orwhere('package', 'dedicated')
                                                    ->orwhere('package', 'pro');
                                            
                                        })->orderBy('id', 'DESC')->first();
                
//                print_r($expiryDateObj);exit;
                
                if (strtotime($expiryDateObj->expires_at) < time()) {
                    if ($userDetails['bids'] > 0) {
                        goto deuductAndSaveBid;
                    } else {
                        return redirect("dashboard")->withErrors("You Membership Expired at ".date("Y-m-d", strtotime($expiryDateObj->expires_at)));
                    }
                }
                $userObj->bids = ($userDetails['bids']-1);
                $userObj->save();
            } else {
                goto deuductAndSaveBid;
            }
            
            deuductAndSaveBid : {
                $userObj->bids = ($userDetails['bids']-1);
                $userObj->save();
                if ($userDetails['bids']-1 == 2) {
                    if ($subscriptions->quotes_left_notification) {
                        $userEmail = $userDetails['email'];
                        $userAEmail = $userDetails['approval_email'];
                        $userData['userFullName'] = $userDetails['first_name']." ".$userDetails['last_name'];
                        Mail::send('emails.two_quotes_left', $userData, function($message) use ($userEmail, $userAEmail){
                            $message->to($userEmail)
                                ->subject('Only Two Quotes Left');
                            if ($userAEmail != null)
                                $message->cc($userAEmail);
                            $message->from(SENDER_EMAIL, SENDER_NAME);
                        });
                    }
                }
            }
            
            $request->merge(array("supplier_id" => $this->userid));
            $request->merge(array('description' => nl2br($request->get('description'))));
    //        printr($request->all());
            $quoteid = ModelQuotes::create($request->except("_token", "quoteFile"));

            if ($request->file('quoteFile') != null) {
                $fileName = saveOrReplaceFile("img/requests", $request->file('quoteFile'), "", $quoteid['id']);
                $quoteDetails = ModelQuotes::find($quoteid['id']);
                $quoteDetails->quoteFile = $fileName;
                $quoteDetails->save();
            }

            $buyerDetails = User::leftJoin('request_service as rs', 'rs.buyer_id', '=', 'users.id')->leftJoin('emails_subscription as es', 'es.userid', 
                                '=', 'users.id')->select('es.*', 'users.first_name', 'users.last_name', 'users.email','users.approval_email')
                                ->where('rs.id', $request->get("request_id"))->get()->toArray();
            
            
            $data = ['supplierName' => Auth::user()->first_name." ".substr(Auth::user()->last_name, 0, 1), "request_id" => $request->get("request_id"), 
                        'buyerName' => $buyerDetails[0]['first_name']." ".$buyerDetails[0]['last_name']];
            $email = $buyerDetails[0]['email'];
  $aprovalemail=$buyerDetails[0]['approval_email'];

            DB::table('quotes_invitation')->where('request_id', $request->get('request_id'))->where('supplier_id', $this->userid)->update(['status' => 1]);
            
            if ($buyerDetails[0]['email']) {
                
                 $qoute_receiveNotification = DB::table('notification')
                        ->where('notificationName', 'qoute_receive')
                        ->first();
                $buyer = strtr($qoute_receiveNotification->content, ["@buyerName" => $buyerDetails[0]['first_name']." ".$buyerDetails[0]['last_name'], "@supplierName" => Auth::user()->first_name." ".substr(Auth::user()->last_name, 0, 1),
                    "@requesturl" => url('project-details/'.$request->get("request_id")),'@click_here'=>url('unsubscribe')]);

                $data = ['emailbody' => $buyer];
                Mail::send('emails.quote_received', $data, function($message) use ($email ,$aprovalemail){
                    $message->to($email)
                        ->subject('A new Quote Received');
                    if($aprovalemail != null)
                        $message->cc($aprovalemail);
                    $message->from(SENDER_EMAIL, SENDER_NAME);
                });
            }
            return redirect("dashboard")->with('message', "Quoted Successfully");
        } else {
            return redirect("dashboard")->withErrors("you don't have any membership. Please buy membership or credit to send quote. "
                                                        ."<a href='".url('membership')."'>Buy Membership</a>");
        }
    }
    
    public function RejectQuoteInvitaion ($id) {
        DB::table('quotes_invitation')->where('id', $id)->update(['status' => 2]);
        return redirect("dashboard")->with('message', "Quote Rejected Successfully");
    }
    
    public function AcceptQuote ($id) {
        $quoteDetails = ModelQuotes::find($id);
        $quoteDetailsArray = $quoteDetails->toArray();
        $requestid = $quoteDetailsArray['request_id'];
        
        $requestedServicd = ModelRequestService::find($requestid);
        
        if ($requestedServicd->buyer_id == $this->userid) {
	        ModelQuotes::where('request_id', $requestid)->update(['status' => 2, 'accept_status' => 1]);
	        $quoteDetails->status = 1;
	        $quoteDetails->save();
	        
	        $requestedServicd->status = 3;
	        $requestedServicd->save();
	        
	        
                $users['buyer'] =  Auth::user()->toArray();
                
	        $users['supplier'] = User::select('id', 'email', 'first_name', 'last_name','approval_email')->where('id', $quoteDetailsArray['supplier_id'])->first()->toArray();
	        
	        $buyerEmail = "";
	        $supplierEmil = "";
                 $supplierAEmil="";
                 $buyerAEmail="";
	        $userDetails = ['supplierFirstName' => '', 'supplierLastName' => '', 'buyerFirstName' => '', 'buyerLastName' => ''];
	        $supplierSubscriptions = null;
	        $buyerSubscriptions = null;
	        
			
	        foreach ($users as $key => $user) {
	            if ($key == 'supplier') {
	                $supplierEmil = $user['email'];
	                $supplierAEmil = $user['approval_email'];
                        
	                $userDetails['supplierFirstName'] = $user['first_name'];
	                $userDetails['supplierLastName'] = $user['last_name'];
	                
	                $supplierSubscriptions = DB::table('emails_subscription')->where('userid', $user['id'])->first();
	            } else {
	                $buyerEmail = $user['email'];
	                $buyerAEmail = $user['approval_email'];
	                $userDetails['buyerFirstName'] = $user['first_name'];
	                $userDetails['buyerLastName'] = $user['last_name'];
	               
	                $buyerSubscriptions = DB::table('emails_subscription')->where('userid', $user['id'])->first();
					
	            }
	        }
			if (!empty($buyerSubscriptions)) 
	        if ($buyerSubscriptions->quote_notification) {


                $qoute_accepted_buyerNotification = DB::table('notification')
                        ->where('notificationName', 'qoute_accepted_buyer')
                        ->first();
                $buyer = strtr($qoute_accepted_buyerNotification->content, ["@buyerFirstname" => $userDetails['buyerFirstName'], "@buyerLastname" => $userDetails['buyerLastName'],
                    "@supplierFirstName" => $userDetails['supplierFirstName'], "@supplierLastName" => substr($userDetails['supplierLastName'], 0, 1),
                  '@click_here'=>url('unsubscribe') ]);

                $data = ['emailbody' => $buyer];

                Mail::send('emails.quote_accepted_buyer', $data, function($message) use ($buyerEmail,$buyerAEmail) {
                    $message->to($buyerEmail)
                            ->subject('Quote Accepted');
                    if($buyerAEmail != null)
                        $message->cc($buyerAEmail);
                    $message->from(SENDER_EMAIL, SENDER_NAME);
                });
                
                
            }

            if ($supplierSubscriptions->quote_notification) {
                
                $qoute_accepted_buyerNotification = DB::table('notification')
                        ->where('notificationName', 'qoute_accepted_supplier')
                        ->first();
                $buyer = strtr($qoute_accepted_buyerNotification->content, ["@buyerFirstname" => $userDetails['buyerFirstName'], "@buyerLastname" => substr($userDetails['buyerLastName'], 0, 1),
                    "@supplierFirstName" => $userDetails['supplierFirstName'], "@supplierLastName" => $userDetails['supplierLastName'],'@click_here'=>url('unsubscribe')
                    ]);

                $data = ['emailbody' => $buyer];
                Mail::send('emails.quote_accepted_supplier', $data, function($message) use ($supplierEmil , $supplierAEmil){
                    $message->to($supplierEmil)
                        ->subject('Quote Accepted');
                    if($supplierAEmil != null)
                        $message->cc($supplierAEmil);
                    $message->from(SENDER_EMAIL, SENDER_NAME);
                });
            }
            return redirect("dashboard")->with('message', "Quote Accepted");
        } else {
            return redirect("dashboard");
        }
    }

}