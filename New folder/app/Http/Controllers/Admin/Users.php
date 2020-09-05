<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Http\Controllers\Controller;
use App\ModelStates;
use App\Categories;
use App\User;
use App\transactionsModel;
use File;
use Input;
use Mail;
use Auth;
use DB;
use App\refundModel;
use App\emailSub;
use Illuminate\Http\Request;
use App\Models\BuildingModel;

class Users extends Controller {
    
    public function Index() {
        DB::table('users')->where('notification_status', 1)->update(['notification_status' => 0]);

        $data['pageTitle'] = "All Users";
        $data['pageNO'] = Input::get('page');
        $data['search_action'] = '';
        
        $usersQuery = User::leftJoin('provinces as p', 'p.id', '=', 'users.state')->leftJoin('cities as c', 'c.id', '=', 'users.city')
                ->leftjoin('transactions as tr', 'tr.userid', '=', 'users.id')
                ->select("users.*", 'p.iso as state', 'c.name as city', 'tr.package', 'tr.expires_at')
                ->where("user_type", "!=", 0);

        $data['pagination_params'] = [];

        if (Input::has('search_string')) {
            $data['search_string'] = Input::get('search_string');
        } else {
            $data['search_string'] = '';
        }

        if (!empty($data['search_string'])) {
            $usersQuery->where( function($query) use ($data)
            {
                $query->where('users.first_name', 'LIKE', '%' . $data['search_string'] . '%')->orWhere('users.last_name', 'LIKE', '%' . $data['search_string'] . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $data['search_string'] . '%')->orWhere(DB::raw("CONCAT(users.first_name,' ',users.last_name)"), 'LIKE', '%' . $data['search_string'] . '%')
                    ->orWhere('users.business_name', 'LIKE', '%' . $data['search_string'] . '%');
//                    ->orWhere('users.email', 'LIKE', '%' . $data['search_string'] . '%')->orWhereRaw('CONCAT(users.first_name," ",users.last_name)', 'LIKE', '%' . $data['search_string'] . '%');
            });
            $data['pagination_params']['search_string'] = $data['search_string'];
        }

        $data['users'] = $usersQuery->orderBy('id', 'DESC')->paginate(25);

        return view("admin.users_list", $data);
    }

    public function Buyers() {
        DB::table('users')->where('notification_status', 1)->where('user_type', 1)->orWhere('user_type', 3)->update(['notification_status' => 0]);
        
        $data['pageTitle'] = "All Buyers";
        $data['pageNO'] = Input::get('page');
        $data['search_action'] = 'buyers';
        
        $usersQuery = User::leftJoin('provinces as p', 'p.id', '=', 'users.state')->leftJoin('cities as c', 'c.id', '=', 'users.city')
                        ->select("users.*", 'p.iso as state', 'c.name as city')
                        ->whereIn("user_type", array(1, 3));

        $data['pagination_params'] = [];
        
        if (Input::has('search_string')) {
            $data['search_string'] = Input::get('search_string');
        } else {
            $data['search_string'] = '';
        }

        if (!empty($data['search_string'])) {
            $usersQuery->where( function($query) use ($data)
            {
                $query->where('users.first_name', 'LIKE', '%' . $data['search_string'] . '%')->orWhere('users.last_name', 'LIKE', '%' . $data['search_string'] . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $data['search_string'] . '%')->orWhere(DB::raw("CONCAT(users.first_name,' ',users.last_name)"), 'LIKE', '%' . $data['search_string'] . '%')
                    ->orWhere('users.business_name', 'LIKE', '%' . $data['search_string'] . '%');
            });
            $data['pagination_params']['search_string'] = $data['search_string'];
        }
        
        $data['users'] = $usersQuery->orderBy('id', 'DESC')->paginate(25);

        return view("admin.users_list", $data);
        
    }

    public function Suppliers() {
        DB::table('users')->where('notification_status', 1)->where('user_type', 2)->orWhere('user_type', 3)->update(['notification_status' => 0]);
        
        $data['pageTitle'] = "All Suppliers";
        $data['pageNO'] = Input::get('page');
        $data['search_action'] = 'suppliers';
        
        $usersQuery = User::leftJoin('provinces as p', 'p.id', '=', 'users.state')->leftJoin('cities as c', 'c.id', '=', 'users.city')
                        ->leftjoin('transactions as tr', 'tr.userid', '=', 'users.id')
                        ->select("users.*", 'p.iso as state', 'c.name as city', 'tr.package', 'tr.expires_at')
                        ->whereIn("user_type", array(2, 3));

        $data['pagination_params'] = [];
        
        if (Input::has('search_string')) {
            $data['search_string'] = Input::get('search_string');
        } else {
            $data['search_string'] = '';
        }

        if (!empty($data['search_string'])) {
            $usersQuery->where( function($query) use ($data)
            {
                $query->where('users.first_name', 'LIKE', '%' . $data['search_string'] . '%')->orWhere('users.last_name', 'LIKE', '%' . $data['search_string'] . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $data['search_string'] . '%')->orWhere(DB::raw("CONCAT(users.first_name,' ',users.last_name)"), 'LIKE', '%' . $data['search_string'] . '%')
                    ->orWhere('users.business_name', 'LIKE', '%' . $data['search_string'] . '%');
            });
            $data['pagination_params']['search_string'] = $data['search_string'];
        }
        
        $data['users'] = $usersQuery->orderBy('id', 'DESC')->paginate(25);
        
        return view("admin.users_list", $data);
    }

    public function Add($userid = null) {
        
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        $data['categories'] = Categories::getMainCategories();
        $data['linkedinIndustries'] = DB::table('linkedin_industries')->orderBy('name', "ASC")->get();
        $data['buildings'] =  BuildingModel::select('id', 'building_name')->orderBy('building_name', 'asc')->get();

        if (is_null($userid)) {
            $data['userDetails'] = (object) ['id' => '', 'user_type' => '', 'first_name' => '', 'last_name' => '', 'job_position' => '', 'email' => '',
                        'phone_number' => '', 'mobile_number' => '', 'business_name' => '', 'tax_id' => '', 'state' => '',
                        'describe_product' => '', 'industries_you_buy' => '', 'industries_you_sell' => '', 'city' => '',
                        'postal_code' => '', 'country' => '', 'website' => '', 'company_logo' => '', 'main_categories' => '',
                        'sub_categories' => '', 'service_states' => '', 'service_cities' => '', 'certificate_awards' => '',
                        'service_kilometers' => '', 'bids' => '', 'street_address' => '', 'status' => 1, 'dedicated_url' => '',
                        'package' => '', 'expires_at' => '', 'company_banner' => '', 'subscrption_mnth' => '', 'added_by' => 0, 'building_id' => 0, 'building_name'=>''];
            $data['awards'] = DB::table('awards')
                    ->where('id', '')
                    ->get();
        } else {
            $data['userDetails'] = User::leftJoin('provinces as p', 'p.id', '=', 'users.state')->leftJoin('cities as c', 'c.id', '=', 'users.city')
                            ->leftjoin('transactions as tr', 'tr.userid', '=', 'users.id')
                            ->leftJoin('buildings as b' , 'b.id', '=', 'users.building_id')
                            ->select("users.*", 'p.iso as state1', 'c.name as city1', 'tr.package', 'tr.expires_at', 'b.building_name')
                            ->where("users.id", $userid)->first();

            $awards = explode(",", $data['userDetails']->award);
            $data['awards'] = DB::table('awards')
                    ->whereIn('id', $awards)
                    ->get();
        }
        return view("admin.users_add", $data);
    }

    public function cvsimport() {
        DB::table('users')->where('notification_status', 1)->update(['notification_status' => 0]);
        $data['users'] = User::leftJoin('provinces as p', 'p.id', '=', 'users.state')->leftJoin('cities as c', 'c.id', '=', 'users.city')
                        ->leftjoin('transactions as tr', 'tr.userid', '=', 'users.id')
                        ->select("users.*", 'p.iso as state', 'c.name as city', 'tr.package', 'tr.expires_at')
                        ->where("user_type", "!=", 0)->orderBy('id', 'DESC')->paginate(25);

        $data['pageTitle'] = "All Users";
        $data['pageNO'] = Input::get('page');

        return view('admin.importSupplier', $data);
    }

    public function cvsSave(Request $request) {
        $value = $request->session()->get('admin_user');
        $file = $request->file('csv');
        if ($file != null) {
            $handle = fopen($file, "r");

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $email = DB::table('users')->where('email', $data[2])
                        ->first();

                if ($email == null) {
                    $userid = $value->id;
                    $id_get = DB::table('users')->insertGetId(['first_name' => $data[0], 'last_name' => $data[1], 'email' => $data[2], 'status' => 0, 'phone_number' => $data[3], 'user_type' => 2, 'business_name' => $data[4], 'postal_code' => $data[5], 'main_categories' => $data[6], 'sub_categories' => $data[7], 'service_states' => $data[8], 'service_cities' => $data[9], 'added_by' => $userid]);
                }
            }
            fclose($handle);
        }
        return redirect("admin-panel/users")->with('message', 'add Successfully');
    }

    public function save(UserRequest $request) {
        if ($request->has('building_id') && !empty($request->get('building_id'))) {
            $building_id = $request->get('building_id');
            $building_info = BuildingModel::select('country_id', 'state_id', 'city_id', 'Address', 'postal_code')->where('id', $building_id)->get(); 
            $request->merge(['country' => $building_info[0]->country_id, 'city' => $building_info[0]->city_id , 'state' => $building_info[0]->state_id, 'postal_code'=>$building_info[0]->postal_code, 'street_address'=>$building_info[0]->Address]);
        }
        $transaction = new transactionsModel();
        if ($request->has('top_supplier')) {
            $request->merge(array('top_supplier' => $request->get('top_supplier')));
        } else {
            $request->merge(array('top_supplier' => 0));
        }

        if ($request->has('industries_you_sell')) {
            $request->merge(array('industries_you_sell' => implode(",", $request->get('industries_you_sell'))));
        }
        if ($request->has('industries_you_buy')) {
            $request->merge(array('industries_you_buy' => implode(",", $request->get('industries_you_buy'))));
        }

        if (!empty($request->get('main_categories'))) {
            $request->merge(array('main_categories' => implode(",", $request->get('main_categories'))));
        }
        if (!empty($request->get('sub_categories'))) {
            $request->merge(array('sub_categories' => implode(",", $request->get('sub_categories'))));
        }

        if (!empty($request->get('service_states'))) {
            $request->merge(array('service_states' => implode(",", $request->get('service_states'))));
        }
        if (!empty($request->get('service_cities'))) {
            $request->merge(array('service_cities' => implode(",", $request->get('service_cities'))));
        }

        if (!$request->has('anonymous')) {
            $request->merge(array('anonymous' => 0));
        }

        $request->merge(['company_slug' => makeSlug($request->get('business_name'))]);
        $request->merge(['subscrption_mnth' => $request->get('subscrption_mnth')]);

        $userid = Input::get('userid');
        if (!empty(Input::get('userid'))) {
            $userDetails = User::find(Input::get('userid'));
            $userDetailsArray = $userDetails->toArray();
        }

        $userDataArray = $request->except('_token', 'userid', 'company_logo_file', 'password_confirmation', 'password');

        if ($request->get('password') != "") {
            $request->merge(array('password' => bcrypt($request->get('password'))));
            $userDataArray = $request->except('_token', 'userid', 'company_logo_file', 'password_confirmation');
        }

        if (isset($userDetailsArray) && $userDetailsArray['status'] == 6) {
//        	$userDetails->created_at = \Carbon\Carbon::now()->toDateTimeString();
            $userDetails->status = 1;
        }
        if ($request->get('membership') != null) {
//            $userDetails->membership =$request->get('membership');
        }

        if (!empty(Input::get('userid'))) {
            $userDetails->fill($userDataArray);
            $userDetails->save();
            $createdAT = $userDetailsArray['created_at'];
        } else {
            $userDetailsNew = User::create($userDataArray);
            $userid = $userDetailsNew->id;
            $createdAT = $userDetailsNew->created_at;
        }

        if ($request->file('company_logo_file') != null) {
            $fileName = saveOrReplaceFile("img/compay_logos", $request->file('company_logo_file'), "", $userid, $createdAT);
//            $request->merge(array('company_logo' => $fileName));

            if (!empty($userDetailsArray['company_logo']) &&
                    File::exists(public_path("img/compay_logos/" . getFolderStructureByDate($createdAT) . "/"
                                    . $userDetailsArray['company_logo']))) {
                File::delete("img/compay_logos/" . getFolderStructureByDate($createdAT) . "/" . $userDetailsArray['company_logo']);
            }
            $userDetails = User::find($userid);
            $userDetails->company_logo = $fileName;
            $userDetails->save();
        }

        if ($request->file('company_banner_file') != null) {

            $file1 = saveOrReplaceFile("img/profile_banner", $request->file('company_banner_file'), "", $userid, $createdAT);
//            $request->merge(array('company_banner' => $file1));

            if (!empty($userDetailsArray['company_banner']) &&
                    File::exists(public_path("img/profile_banner/" . getFolderStructureByDate($createdAT) . "/"
                                    . $userDetailsArray['company_banner']))) {
                File::delete("img/profile_banner/" . getFolderStructureByDate($createdAT) . "/" . $userDetailsArray['company_banner']);
            }

            $userDetails = User::find($userid);
            $userDetails->company_banner = $file1;
            $userDetails->save();
        }

        if ($request->get('user_type') != 1) {
            $user_ifo = DB::table('users')
                    ->where('email', $request->get('email'))
                    ->first();
            $user_id = $user_ifo->id;
            $result = emailSub::updateOrCreate(['userid' => $user_id, 'request_notification' => 1, 'quote_notification' => 1, 'message_notification' => 1, 'quotes_left_notification' => 1]);
        }

        if ($request->get('added_by') != 0) {
            $supplier = User::find(Input::get('userid'));
            if ($supplier->added_by != 0 && $request->get('oldStatus') != 1 && $request->get('status') == 1) {
                $random_password = str_random(15);
                $supplier->password = bcrypt($random_password);
                $supplier->save();
                $supplier_email = $request->get('email');
                $buyer_details = User::find($supplier->added_by);
                $aproveNotification = DB::table('notification')
                        ->where('notificationName', 'aprove')
                        ->first();
                $buyer = strtr($aproveNotification->content, ["@siteurl" => url('auth/login'), "@suppliername" => $request->get('first_name'), '@buyer_name' => $buyer_details->first_name,
                    '@useremail' => $request->get('email'), "@passwrd" => $random_password, "@username" => $buyer_details->first_name, '@click_here' => url('unsubscribe')]);

                $data = ['buyer_name' => $buyer_details->first_name, 'suplier_name' => $request->get('first_name'), "suplier_email" => $request->get('email'), "suplier_password" => $random_password, 'emailbody' => $buyer];
                Mail::send('emails.supplier_approved', $data, function($message) use ($supplier_email) {
                    $message->to($supplier_email)
                            ->subject('Account Approved');
                    $message->from(SENDER_EMAIL, SENDER_NAME);
                });
            }
        }
		
		if($request->get('user_type') == 2 && $request->get('status') == 1 && ($request->get('added_by') == 0 || (isset($userDetailsArray) && $userDetailsArray['status'] == 6)))
		{
			$supplierEmail = $request->get('email');//$userDetailsArray['email'];//echo '<p>'.$supplierEmail.'</p>';exit();
			$supplierAproveNotification = DB::table('notification')
                        ->where('notificationName', 'supplier_approved')
                        ->first();
			$supplierData = strtr($supplierAproveNotification->content, ["@loginURL" => url('auth/login'), "@supplierName" => $request->get('first_name'), "@userEmail" => $request->get('email'), '@click_here' => url('unsubscribe')]);
			$data = ['emailbody' => $supplierData];
			Mail::send('emails.supplier_approved', $data, function($message) use ($supplierEmail) {
				$message->to($supplierEmail)
						->subject('Account Approved');
				$message->from(SENDER_EMAIL, SENDER_NAME);
			});
		}

//        If supplier approved by admin, temporary account will be assigned to supplier
        $transaction1 = DB::table('transactions')
                ->where('userid', $userid)
                ->get();
        if ($transaction1 == null) {
            if ($request->input('membership') == 'pro') {
                $transaction->package = 'pro';
            } else {
                $transaction->package = $request->input('membership');
            }

            $transaction->userid = $userid;
            $transaction->expires_at = $request->get('datexpire');
            $transaction->save();
        } else {
            $pakage = "";
            $bids = "";

            if ($request->input('membership') == 'pro') {
                $pakage = 'pro';
                $bids = $request->input('numbid');
            } else {
                $pakage = $request->input('membership');
            }

            $transaction = DB::table('transactions')
                    ->where('userid', $userid)
                    ->update(['userid' => $userid, 'package' => $pakage, 'expires_at' => $request->get('datexpire')]);

            $transaction = DB::table('users')
                    ->where('id', $userid)
                    ->update(['membership' => $pakage, 'bids' => $bids]);
        }
        return redirect("admin-panel/users")->with('message', 'Updated Successfully');
    }

    public function Delete() {
        $userid = Input::get('id');
        User::destroy($userid);
        DB::table('suplier_buyerrel')->where('supplier_id', $userid)->orwhere('buyer_id', $userid)->delete();
        return redirect("admin-panel/users")->with('message', 'Deleted Successfully');
    }

    public function refunds() {
        $data['refunds'] = DB::table('refund as re')
                        ->leftjoin('users as u', 'u.id', '=', 're.user_id')
                        ->select('re.*', 'u.business_name as supplierName', 'u.id as supplierId')
                        ->orderBy('re.id', 'DESC')->paginate(15);

        return view('admin.refund', $data);
    }

    public function Refundedit($id) {
        $data['refund'] = DB::table('refund as ref')
                        ->leftjoin('users as u', 'u.id', '=', 'ref.user_id')
//        $data['refund'] = refundModel::le
                        ->select('ref.*', 'u.business_name as supplierName', 'u.email', 'u.approval_email')
                        ->where('ref.id', $id)->first();

        return view('admin.refund_detail', $data);
    }

    public function Refundaprover(Request $request, $id) {
        $gister = ['status' => 1, 'comment' => $request->get('comment')];
        $data['register'] = refundModel::updateOrCreate(['id' => $id], $gister);
        $email = $request->get('email');
        $approval_email = $request->get('approval_email');

        $refund_userNotification = DB::table('notification')
                ->where('notificationName', 'refund_user')
                ->first();
        $buyer = strtr($refund_userNotification->content, ["@comment" => $request->get('comment'),]);

        $data = ['emailbody' => $buyer];

        Mail::send('emails.gernalnotification', $data, function($message) use ($email, $approval_email) {
            $message->to($email)
                    ->subject('Refund Reply');
            if ($approval_email != null)
                $message->cc($approval_email);
            $message->from(SENDER_EMAIL, SENDER_NAME);
        });
        return redirect('admin-panel/refund')->with('message', 'Your Comment is successfully sent to User');
    }
}
