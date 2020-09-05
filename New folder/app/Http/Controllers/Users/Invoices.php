<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Mail;
use Input;
use App\Models\ModelInvoice;
use App\Http\Requests\Users\RequestSendInvoice;

class Invoices extends Controller {

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
        $data['metas'] = get_page_meta_array('Invoices');
        
        $data['invoices'] = DB::table('invoices as i')->leftJoin('request_service AS rs', 'rs.id', '=', 'i.request_id')
                                                      ->leftJoin('users AS bu', 'bu.id', '=', 'i.buyer_id')
                                                      ->leftJoin('quotes AS q', 'q.request_id', '=', 'i.request_id')
                                                      ->select('rs.id', 'rs.title', 'bu.first_name AS b_first_name', 'bu.id', 'bu.last_name AS b_last_name', 
                                                               'i.amount AS amount', 'i.tax_percent', 'i.total_amount', 'i.created_at')
                                                      ->where('i.supplier_id', Auth::id())
                                                      ->get();
        return view('users.my_invoices', $data);
    }

    public function Add() {
        $data = $this->viewData;
        $data['userid'] = $this->userid;
        $data['metas'] = get_page_meta_array('Add Invoice');
        
        $data['requests'] = DB::table('quotes as q')->leftJoin('request_service AS rs', 'rs.id', '=', 'q.request_id')
                                                    ->leftJoin('users AS u', 'u.id', '=', 'rs.buyer_id')
                                                    ->where('q.supplier_id', $this->userid)
                                                    ->where('q.status', 1)
                                                    ->select('rs.id', 'rs.title', 'u.id as buyer_id', 'u.first_name', 'u.last_name')->get();
        return view('users.add_invoices', $data);
    }

    public function Send(RequestSendInvoice $request) {
        $user = Auth::user();
        $data['request_service_info'] = DB::table('request_service')->select('title')->where('id', $request->get('request_id'))->first();
        $data['buyer_details'] = DB::table('users')->select('email','approval_email','business_name')->where('id', $request->get('buyer_id'))->first();
        $data['tax_percent'] = DB::table('provinces')->select('tax_percent')->where('id', $user->state)->first();
        
        $buyer_business_name = $data['buyer_details']->business_name ? ", " .$data['buyer_details']->business_name : "";
        
        $buyerEmail = $data['buyer_details']->email;
        $buyerAEmail = $data['buyer_details']->approval_email;
        $supplier_email = $user->email;
        $tax_amount = ((($request->get('amount') / 100) * $data['tax_percent']->tax_percent) + $request->get('amount'));
        
        $d_membership_request = DB::table('notification')->where('notificationName','supplier_invoice')->first();
        $parm_array = ["@request_title" => $data['request_service_info']->title, 
                       "@buyer_name" => $request->get('buyer'). $buyer_business_name, 
                       "@supplier_name" => $user->first_name . " " . $user->last_name . ", " . $user->business_name, 
                       "@date_now" => date('Y/m/d'),
                       "@price" => $request->get('amount'), 
                       "@tax_percent" => $data['tax_percent']->tax_percent,
                       "@description" => $request->get('description'),
                       "@to_be_paid_by" => $request->get('to_be_paid_by'),
                       "@total_amount" => $tax_amount];
        $d_membership_requestN  = strtr($d_membership_request->content, $parm_array);
        
        $invoice = ['request_id' => $request->get('request_id'), 'buyer_id' => $request->get('buyer_id'), 'supplier_id' => $user->id, 
                    'description' => $request->get('description'),'amount' => $request->get('amount'), 'tax_percent' => $data['tax_percent']->tax_percent, 
                    'total_amount' => $tax_amount];
                    
        $invoiceid = ModelInvoice::create($invoice);
        
        $data = ['emailbody' => $d_membership_requestN];
        Mail::send('emails.supplier_invoice',$data, function($message) use ($buyerEmail, $buyerAEmail, $supplier_email){
            $message->to($buyerEmail)
                ->subject('Invoice');
            if ($buyerAEmail != null)
                $message->cc($buyerAEmail);
            $message->from($supplier_email);
        });
        
        return redirect('invoices');
    }
}
