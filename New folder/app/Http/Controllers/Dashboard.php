<?php namespace App\Http\Controllers;

use Auth;
use DB;
use Mail;
use App\User;
use App\ModelRequestService;
use App\Models\ModelQuotes;
use App\refundModel;
use Illuminate\Http\Request;

class Dashboard extends Controller {
    
    protected $viewData = array();
    protected $userid;
 
    
    public function __construct() {
        $this->viewData['userType'] = Auth::userType();
        $this->userid = Auth::id();

//        $totalNewMessages = User::rightJoin('messages as m', 'm.sender_id', '=', 'users.id')->leftJoin('quotes as q', 'q.id', '=', 'm.quote_id')
//                                ->leftJoin('request_service as rs', 'rs.id', '=', 'q.request_id')->select(DB::raw('COUNT(m.id) as newMessages'))
//                                ->where('users.id', '!=', $this->userid);
        $this->viewData['dashboardUser'] = "Contractor";
        $this->viewData['userPostType'] = "Quote";
        $this->viewData['userPostResponser'] = "Condo Owner";

        if ($this->viewData['userType'] == 1) {
            $this->viewData['dashboardUser'] = "Service Buyer ";
            $this->viewData['userPostType'] = "Request";
            $this->viewData['userPostResponser'] = "Contractor";
        }
    }
    
    public function index() {
        $data = $this->viewData;
        
      $data['userDetails'] = User::find(Auth::id());
        
        $data['metas'] = get_page_meta_array($data['dashboardUser'].' Dashboard');

        if($data['userDetails']->added_by!=0){
            
            return redirect('complete-profile');
        }
        
        if ($data['userType'] == 1) {
            $data['requests'] = User::find($this->userid)->requestedServices()
                                    ->leftJoin(DB::raw('(SELECT * FROM quotes WHERE status = 1) as q'), 'q.id', '=', 'request_service.id')
                                    ->select('request_service.*', 'q.price', 'q.status as quoteStatus')->orderBy('id', 'desc')->get()->toArray();
//            $data['requests'] = DB::select("select r.*, q.price, q.status as quoteStatus from request_service as r, quotes as q where q.request_id = r.id "
//                                    ."AND r.buyer_id = ".$this->userid." AND q.status = 1 group by r.id ORDER BY r.id DESC");
        } else {
            DB::table('quotes_invitation')->where('notification_status', 1)->where('supplier_id', $this->userid)->update(['notification_status' => 0]);
            $query = "select qi.id as quoteInvitaionid, qi.supplier_id, qi.status as quoteInvitaionStatus, r.*, q.price, q.status as quoteStatus "
                        ."from quotes_invitation as qi LEFT JOIN request_service as r on qi.request_id = r.id "
                        ."LEFT JOIN (SELECT * FROM quotes WHERE supplier_id = ".$this->userid.") as q ON q.request_id = r.id LEFT JOIN (SELECT * FROM invoices) "
                        ."as i ON i.request_id = r.id WHERE qi.supplier_id = ".$this->userid." group by qi.id ORDER BY qi.id DESC";
            $data['requests'] = DB::select($query);
        }
        
        return view('dashboard', $data);
    }

    public function Refundfrom(){
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Refund');
        
        return view('refund',$data);
    }
    
    public function Refund(Request $request){
        
        $refund = new refundModel();
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Refund');
        $refund->reason = $request->get('reason');
        $refund->transaction_reference = $request->get('refrence_transaction');
        $refund->subject = $request->get('subject');
        $refund->transaction = $request->get('transaction');
        $refund->user_id = Auth::id();

        $refund->save();
        $claim_profile_adminNotification = DB::table('notification')
                                    ->where('notificationName','refund_user_admin')
                                    ->first();    

        $admin_emailN  = strtr($claim_profile_adminNotification->content, ["@refund"=>  url('admin-panel/refund'),]);

        $data = ['emailbody' => $admin_emailN];


        Mail::send('emails.gernalnotification', $data, function($message) {
            $message->to(getSettings('notification_email'))
                    ->subject('Claim Profile Request');
            $message->from(SENDER_EMAIL, SENDER_NAME);
        });
//         Mail::send('emails.dedicated_membership_request',$data, function($message) {
//            $message->to(getSettings('notification_email'))
//                ->subject('Dedicated Membership Request Received');
//            $message->from('info@firmogram.com', 'Firmogram');
//        });
        return redirect("profile")->with('message', 'Your Request Sent Successfully. Firmogram Team Will Contact You Shortly.');
    }

    public function Transactions() {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Transactions');
        
        $data['transactions'] = DB::table('transactions as t')->leftJoin('users as u', 'u.id', '=', 't.userid')
                                    ->select('t.package', 't.amount', 't.expires_at', 't.created_at', 'u.bids')
                                    ->where('u.id', $this->userid)->orderBy('t.id', "DESC")->get();
        
        return view('users.transactions', $data);
    }

    public function Membership() {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Membership');
        
        $data['userDetail']=  User::find(Auth::id());
        $data['subscrption_mnth']=  0;
        
        if($data['userDetail']->subscrption_mnth != 0){
            $data['subscrption_mnth'] =  $data['userDetail']->subscrption_mnth;
        }else{
            
            $data['subscrption_mnth_admin_setting']=  DB::table('settings')
                                                       ->where('key','mnth')->first();
            
            $data['subscrption_mnth'] = $data['subscrption_mnth_admin_setting']->value;
        }
        
        return view('membership', $data);
    }

    public function DedicatedMembershipRequest() {
        $userInfo = Auth::user();
        
         $d_membership_request = DB::table('notification')
                                        ->where('notificationName','d_membership_request')
                                        ->first();  
        $d_membership_requestN  = strtr($d_membership_request->content, ["@userEmail" => $userInfo->email,]);
            
            $data = ['emailbody' => $d_membership_requestN];
        
         
        Mail::send('emails.dedicated_membership_request',$data, function($message) {
            $message->to(getSettings('notification_email'))
                ->subject('Dedicated Membership Request Received');
            $message->from(SENDER_EMAIL, SENDER_NAME);
        });
        
        return redirect("membership")->with('message', 'Your Request Sent Successfully. Firmogram Team Will Contact You Shortly.');
    }

    public function purchaseCredits() {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Purchase Credits');
        return view('purchase_credits', $data);
    }

    public function projectDetails($id) {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Project Details');
        if ($data['userType'] == 1) {
            $data['request'] = ModelRequestService::leftJoin(DB::raw('(SELECT * FROM quotes WHERE status = 1) as q'), 'q.request_id', '=', 'request_service.id')
                    ->leftjoin('reviews_testimonials as rt','rt.request_id','=','request_service.id')            
                    ->select('request_service.*', 'q.price', 'q.status as quoteStatus','rt.request_id as reviewRequest' ,
                                        DB::raw("(SELECT name FROM category_description WHERE category_id = request_service.main_categories) as mainCat"), 
                                        DB::raw("(SELECT name FROM category_description WHERE category_id = request_service.sub_categories) as subCat"), 
                                        DB::raw("(SELECT name FROM cities WHERE id = request_service.city) as cityName"), 
                                        DB::raw("(SELECT name FROM provinces WHERE id = request_service.state) as stateName"))
                                ->where('request_service.id', $id)->get()->toArray();
            
            $data['request'] = (array) $data['request'][0];
         
            $data['quotes'] = ModelQuotes::leftJoin('users as u', 'u.id' , '=', 'quotes.supplier_id')
                                    ->select('quotes.*', 'u.first_name', 'u.last_name', 'u.business_name')
                                    ->where('request_id', $id)->orderBy('created_at', 'DESC')->get()->toArray();
            $data['supplierCount']=DB::table('quotes_invitation as qi')
                            ->where('qi.request_id',$id)
                            ->count();
        } else {
            $query = "select qi.id as quoteInvitaionid, qi.supplier_id, qi.status as quoteInvitaionStatus, r.*, q.price, q.status as quoteStatus, "
                        ."r.estimated_budget, (SELECT name FROM category_description WHERE category_id = r.sub_categories) as subCat, "
                        ."(SELECT name FROM category_description WHERE category_id = r.main_categories) as mainCat, (SELECT name FROM cities WHERE "
                        ."id = r.city) as cityName, (SELECT name FROM provinces WHERE id = r.state) as stateName "
                        ."from quotes_invitation as qi LEFT JOIN request_service as r on qi.request_id = r.id "
                        ."LEFT JOIN (SELECT * FROM quotes WHERE supplier_id = ".$this->userid.") as q ON q.request_id = r.id "
                        ."WHERE qi.supplier_id = ".$this->userid." AND r.id = $id group by qi.id ORDER BY qi.id DESC";
            $data['request'] = DB::select($query);
            $data['request'] = (array) $data['request'][0];
            
            $data['quotes'] = ModelQuotes::leftJoin('users as u', 'u.id' , '=', 'quotes.supplier_id')
                                    ->select('quotes.*', 'u.first_name', 'u.last_name', 'u.business_name')
                                    ->where('request_id', $id)->where('u.id', $this->userid)->orderBy('created_at', 'DESC')->get()->toArray();
        }
        return view('request_details', $data);
    }

    public function homeprojectDetails($id) {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Project Details');
         {
            $data['request'] = ModelRequestService::leftJoin(DB::raw('(SELECT * FROM quotes WHERE status = 1) as q'), 'q.request_id', '=', 'request_service.id')
                        ->leftJoin('provinces as pr','pr.id','=','request_service.state')
                    ->select('request_service.*', 'q.price', 'q.status as quoteStatus', 'pr.iso',
                                        DB::raw("(SELECT name FROM category_description WHERE category_id = request_service.main_categories) as mainCat"), 
                                        DB::raw("(SELECT name FROM category_description WHERE category_id = request_service.sub_categories) as subCat"), 
                                        DB::raw("(SELECT name FROM cities WHERE id = request_service.city) as cityName"), 
                                        DB::raw("(SELECT name FROM provinces WHERE id = request_service.state) as stateName"))
                                ->where('request_service.id', $id)->get()->toArray();
            
            $data['request'] = (array) $data['request'][0];
         
            $data['quotes'] = ModelQuotes::leftJoin('users as u', 'u.id' , '=', 'quotes.supplier_id')
                                    ->select('quotes.*', 'u.first_name', 'u.last_name', 'u.business_name')
                                    ->where('request_id', $id)->orderBy('created_at', 'DESC')->get()->toArray();
            $data['supplierCount']=DB::table('quotes_invitation as qi')
                            ->where('qi.request_id',$id)
                            ->count();
            $data['buyer_detail']= User::find($data['request']['buyer_id']);
        }
        return view('homeRequest_detail', $data);
    }
    
    public function Respond_to_this_requestForm ($id){
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('respondTorequest');
        $data['requestid']=$id;
        $data['request'] = ModelRequestService::find($id);
        
        return view('respondTorequest',$data);
    }

    public function Respond_to_this_request(Request $request, $id){
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('respondTorequest');
        $data['requestid']=$id;
        $data['request'] = ModelRequestService::find($id);

        $data['supplier']=User::find($this->userid);
        
        $claim_profile_adminNotification = DB::table('notification')
                                        ->where('notificationName','respond_to_request')
                                        ->first();    
            
            $admin_emailN  = strtr($claim_profile_adminNotification->content, ["@user" => $data['supplier']->business_name,
                                    '@respond' => $request->get('message'), '@request_id' => $id, 
                                    '@request' => url('homepage-project-details/'.$id)]);
            
            $data = ['emailbody' => $admin_emailN];
            Mail::send('emails.gernalnotification', $data, function($message) {
                $message->to(getSettings('notification_email'))
                        ->subject('Respond to Request');
                $message->from(SENDER_EMAIL, SENDER_NAME);
            });
        return redirect('homepage-project-details/'.$id);
        
    }


    
    public function viewRequestSuppliers($id) {
         $data = $this->viewData;
        $data['metas'] = get_page_meta_array($data['dashboardUser'].' Dashboard');
        $data['viewReuest']=DB::table('quotes_invitation as qi')
                            ->leftjoin('users','users.id','=','qi.supplier_id')
                            ->where('qi.request_id',$id)
                            ->get();
//                    print_r($data);
//                    exit();
        return view('viewRequestSupplier', $data);
    }
    
    
    public function viewSuppliers() {
        $data = $this->viewData;
        return view('view_suppliers', $data);
    }

}
