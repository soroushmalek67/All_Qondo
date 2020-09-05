<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\notificationModel;
use Input;
use DB;
use Mail;
use App\User;
use App\Categories;
use Illuminate\Http\Request;

class notificationController extends Controller {

    public function Index() {
//        exit();
        
       $data['register'] = notificationModel::where('notificationName','register')->first(); 
       $data['aprove'] = notificationModel::where('notificationName','aprove')->first(); 
       $data['add_supplier'] = notificationModel::where('notificationName','add_supplier')->first(); 
       $data['claim_profile'] = notificationModel::where('notificationName','claim_profile')->first(); 
       $data['claim_profile_admin'] = notificationModel::where('notificationName','claim_profile_admin')->first(); 
       $data['contactus'] = notificationModel::where('notificationName','contactus')->first(); 
       $data['d_membership_request'] = notificationModel::where('notificationName','d_membership_request')->first(); 
       $data['duplicate_company'] = notificationModel::where('notificationName','duplicate_company')->first(); 
       $data['send_message'] = notificationModel::where('notificationName','send_message')->first(); 
       $data['rest_password'] = notificationModel::where('notificationName','rest_password')->first(); 
       $data['qoute_accepted_buyer'] = notificationModel::where('notificationName','qoute_accepted_buyer')->first(); 
       $data['qoute_accepted_supplier'] = notificationModel::where('notificationName','qoute_accepted_supplier')->first(); 
       $data['qoute_invitation'] = notificationModel::where('notificationName','qoute_invitation')->first(); 
       $data['qoute_receive'] = notificationModel::where('notificationName','qoute_receive')->first(); 
       $data['user_create'] = notificationModel::where('notificationName','user_create')->first(); 
       $data['request_approve'] = notificationModel::where('notificationName','request_approve')->first(); 
       $data['request_rejected'] = notificationModel::where('notificationName','request_rejected')->first(); 
       $data['review'] = notificationModel::where('notificationName','review')->first(); 
       $data['service_request_created'] = notificationModel::where('notificationName','service_request_created')->first(); 
       $data['service_request_created_emil'] = notificationModel::where('notificationName','service_request_created_emil')->first(); 
       $data['quotes_left'] = notificationModel::where('notificationName','quotes_left')->first(); 
       $data['registered_email'] = notificationModel::where('notificationName','registered_email')->first(); 
       $data['request_edit'] = notificationModel::where('notificationName','request_edit')->first(); 
       $data['supplier_invoice'] = notificationModel::where('notificationName','supplier_invoice')->first();
       $data['template_image'] = notificationModel::where('notificationName','template_image')->first();
       $data['refund_user'] = notificationModel::where('notificationName','refund_user')->first();
       $data['refund_user_admin'] = notificationModel::where('notificationName','refund_user_admin')->first();
       $data['respond_to_request'] = notificationModel::where('notificationName','respond_to_request')->first();
       
       
//       print_r($data['refund_user_admin']);
//       exit();
        return view("admin.notificationContent",$data);
    }
    public function update(Request $request) {
//        $newCity = ModelCities::updateOrCreate(['id' => $request->get('id')], $request->except("_token", "id"));
//       $data['register'] = notificationModel::where('notificationName','register')->first();
        
        $gister=['content'=>$request->get('register')];
       $data['register'] = notificationModel::updateOrCreate(['notificationName' => 'register'], $gister); 
        $gister=['content'=>$request->get('aprove')];
       $data['aprove'] = notificationModel::updateOrCreate(['notificationName' => 'aprove'], $gister); 
        $gister=['content'=>$request->get('addsupplier')];
       $data['add_supplier'] = notificationModel::updateOrCreate(['notificationName' => 'add_supplier'], $gister); 
        $gister=['content'=>$request->get('claim_profile')];
       $data['claim_profile'] = notificationModel::updateOrCreate(['notificationName' => 'claim_profile'], $gister); 
       
        $gister=['content'=>$request->get('claim_profile_admin')];
//        print_r($gister);exit();
       $data['claim_profile_admin'] = notificationModel::updateOrCreate(['notificationName' => 'claim_profile_admin'], $gister); 
       
        $gister=['content'=>$request->get('contactus')];
//        print_r($gister);exit();
       $data['contactus'] = notificationModel::updateOrCreate(['notificationName' => 'contactus'], $gister); 
       
        $gister=['content'=>$request->get('d_membership_request')];
//        print_r($gister);exit();
       $data['d_membership_request'] = notificationModel::updateOrCreate(['notificationName' => 'd_membership_request'], $gister); 
       
        $gister=['content'=>$request->get('duplicate_company')];
//        print_r($gister);exit();
       $data['duplicate_company'] = notificationModel::updateOrCreate(['notificationName' => 'duplicate_company'], $gister); 
       
        $gister=['content'=>$request->get('send_message')];
//        print_r($gister);exit();
       $data['send_message'] = notificationModel::updateOrCreate(['notificationName' => 'send_message'], $gister); 
       
        $gister=['content'=>$request->get('rest_password')];
//        print_r($gister);exit();
       $data['rest_password'] = notificationModel::updateOrCreate(['notificationName' => 'rest_password'], $gister); 
       
        $gister=['content'=>$request->get('qoute_accepted_buyer')];
//        print_r($gister);exit();
       $data['qoute_accepted_buyer'] = notificationModel::updateOrCreate(['notificationName' => 'qoute_accepted_buyer'], $gister); 
       
        $gister=['content'=>$request->get('qoute_accepted_supplier')];
//        print_r($gister);exit();
       $data['qoute_accepted_supplier'] = notificationModel::updateOrCreate(['notificationName' => 'qoute_accepted_supplier'], $gister); 
       
        $gister=['content'=>$request->get('qoute_invitation')];
//        print_r($gister);exit();
       $data['qoute_invitation'] = notificationModel::updateOrCreate(['notificationName' => 'qoute_invitation'], $gister); 
       
        $gister=['content'=>$request->get('qoute_receive')];
//        print_r($gister);exit();
       $data['qoute_receive'] = notificationModel::updateOrCreate(['notificationName' => 'qoute_receive'], $gister); 
       
        $gister=['content'=>$request->get('user_create')];
//        print_r($gister);exit();
       $data['user_create'] = notificationModel::updateOrCreate(['notificationName' => 'user_create'], $gister); 
       
       
        $gister=['content'=>$request->get('request_approve')];
//        print_r($gister);exit();
       $data['request_approve'] = notificationModel::updateOrCreate(['notificationName' => 'request_approve'], $gister); 
       
       
        $gister=['content'=>$request->get('request_rejected')];
//        print_r($gister);exit();
       $data['request_rejected'] = notificationModel::updateOrCreate(['notificationName' => 'request_rejected'], $gister); 
       
        $gister=['content'=>$request->get('review')];
//        print_r($gister);exit();
       $data['review'] = notificationModel::updateOrCreate(['notificationName' => 'review'], $gister); 
       
       
        $gister=['content'=>$request->get('service_request_created')];
//        print_r($gister);exit();
       $data['service_request_created'] = notificationModel::updateOrCreate(['notificationName' => 'service_request_created'], $gister); 
       
        $gister=['content'=>$request->get('service_request_created_emil')];
//        print_r($gister);exit();
       $data['service_request_created_emil'] = notificationModel::updateOrCreate(['notificationName' => 'service_request_created_emil'], $gister); 
       
       
        $gister=['content'=>$request->get('quotes_left')];
//        print_r($gister);exit();
       $data['quotes_left'] = notificationModel::updateOrCreate(['notificationName' => 'quotes_left'], $gister); 
       
       
        $gister=['content'=>$request->get('registered_email')];
//        print_r($gister);exit();
       $data['registered_email'] = notificationModel::updateOrCreate(['notificationName' => 'registered_email'], $gister); 
       
       
        $gister=['content'=>$request->get('request_edit')];
//        print_r($gister);exit();
       $data['request_edit'] = notificationModel::updateOrCreate(['notificationName' => 'request_edit'], $gister); 
       
        $gister=['content'=>$request->get('supplier_invoice')];
//        print_r($gister);exit();
       $data['supplier_invoice'] = notificationModel::updateOrCreate(['notificationName' => 'supplier_invoice'], $gister); 
       
       
        $gister=['content'=>$request->get('refund_user')];
//        print_r($gister);exit();
       $data['refund_user'] = notificationModel::updateOrCreate(['notificationName' => 'refund_user'], $gister); 
       
       
        $gister=['content'=>$request->get('refund_user_admin')];
//        print_r($gister);exit();
       $data['refund_user_admin'] = notificationModel::updateOrCreate(['notificationName' => 'refund_user_admin'], $gister); 
       
       
        $gister=['content'=>$request->get('respond_to_request')];
//        print_r($gister);exit();
       $data['respond_to_request'] = notificationModel::updateOrCreate(['notificationName' => 'respond_to_request'], $gister); 
       
       
//       print_r($request->all()); exit();
       
       if ($request->file('template_file') != null) {
            $fileName = saveOrReplaceFile("img/notification_image", $request->file('template_file'), "", 1, "2016-09-06");
//             print_r($fileName);             exit();
//            $request->merge(array('template_file' => $fileName));
            $gister=['template_image'=>$fileName,'created_at'=>'2016-09-06'];
        $data['template_file'] = notificationModel::updateOrCreate(['notificationName' => 'template_image'], $gister); 
            if (!empty($userDetailsArray['template_file']) && 
                    File::exists(public_path("img/notification_image/".getFolderStructureByDate("2016-09-06")."/"
                            .$userDetailsArray['template_file']))) {
                File::delete("img/notification_image/".getFolderStructureByDate($request->get('created_at'))."/".$userDetailsArray['template_file']);
            }
        }
       
       
       
//       print_r($data);exit;
        return redirect("admin-panel/notificationContent")->with('message', 'Notifications are Updated');
    }
    
    
}
