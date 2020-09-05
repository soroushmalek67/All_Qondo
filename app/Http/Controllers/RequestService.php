<?php

namespace App\Http\Controllers;

use App\Categories;
use DB;
use Auth;
use App\Http\Requests\RequestRequestService;
use Session;
use App\Services\Registrar;
use App\ModelRequestService;
use Mail;
use App\ModelCities;
use App\ModelStates;
use App\Models\BuildingModel;

class RequestService extends Controller {

    protected $registrar;

    public function __construct() {
        if (!Auth::Guest()) {
            if (Auth::userType() == '2') {
                header("location: " . url('dashboard'));
                exit;
            }
        }
    }

    public function index($catSlug = "", $citySlug = "") {
       
        $user = DB::table('users')->select('building_id')->where('users.id', Auth::id())->first();
		
		if($user->building_id == '0' )
		{
			return redirect('profile')->withErrors(['Building' => "please choose building first."]);
		}
		else
		{
			$building_info = BuildingModel:: select('buildings.status')
                        ->where ('id', $user->building_id)->first();
			if($building_info->status == 0)
			{
				return redirect('profile')->withErrors(['Building' => "Your building is currently being approved. Once approved, you can request a service"]);
			}
			
		}
		
		$data['metas'] = get_page_meta_array('Request Service');
        $data['defaultLocation'] = ['id' => '', 'state' => ''];
        if (!empty($citySlug)) {
            $data['defaultLocation'] = ModelCities::where('slug', $citySlug)->first()->toArray();
        }
        $data['categories'] = Categories::getMainCategories();
        $data['subCategories'] = Categories::getSubCategories();
        $data['selectedCategories'] = "";
        $data['selectedSubCategories'] = "";
        $selectedCategories = Categories::getCategoryBySlug($catSlug);
        if (!empty($selectedCategories)) {
            foreach ($selectedCategories as $selectedCategory) {
                $data['selectedCategories'] = $selectedCategory->parent_id;
                $data['selectedSubCategories'] = $selectedCategory->id;
            }
        }
        if (!empty($data['selectedCategories'])) {
            $data['parent_cat_des'] = DB::table('category')
                    ->join('category_description','category_id', '=', 'category.id')
                    ->select('description')
                    ->where('category.id',  $data['selectedCategories'])
                    ->get();
        } else {
            $data['parent_cat_des'] = '';
           
        }
        
        
        $city_info = BuildingModel:: select('buildings.city_id')
                        ->join('users', 'users.building_id', '=', 'buildings.id')
                        ->where ('users.id', Auth::id())->first();
        
        
        $data['activeSupplier'] = DB::table('suplier_buyerrel as sb')
                        ->leftjoin('users', 'sb.supplier_id', '=', 'users.id')
                        ->where('sb.buyer_id', Auth::id())
                        ->where('sb.status', 1)
                        ->where('users.city', $city_info->city_id)
                        ->select('users.id', 'users.first_name', 'users.last_name')->get();

        $data['openly'] = "";
        $data['supplier_id'] = "";
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        return view('request_service', $data);
    }

    public function indexOpen($flage) {
       
        
        $data['metas'] = get_page_meta_array('Request Service');
        $data['defaultLocation'] = ['id' => '', 'state' => ''];
        if (is_numeric($flage)) {
            $data['selectedCategories'] = "";
            $data['selectedSubCategories'] = "";
        } else {
            $selectedCategories = Categories::getCategoryBySlug($flage);
            if (!empty($selectedCategories)) {
                foreach ($selectedCategories as $selectedCategory) {
                    $data['selectedCategories'] = $selectedCategory->parent_id;
                    $data['selectedSubCategories'] = $selectedCategory->id;
                }
            }
        }
        if (!empty($data['selectedCategories'])) {
            $data['parent_cat_des'] = DB::table('category')
                    ->join('category_description','category_id','=', 'category.id')
                    ->select('description')
                    ->where('category.id',  $data['selectedCategories'])
                    ->get();
        } else {
            $data['parent_cat_des']='';
        }
      
        $data['categories'] = Categories::getMainCategories();
        $data['subCategories'] = Categories::getSubCategories();
//        $data['selectedCategories'] = "";
//        $data['selectedSubCategories'] = "";
        $data['openly'] = $flage;
        $data['supplier_id'] = "";

        $data['activeSupplier'] = DB::table('suplier_buyerrel as sb')
                        ->leftjoin('users', 'sb.supplier_id', '=', 'users.id')
                        ->where('sb.buyer_id', 0)
                        ->select('users.id', 'users.first_name', 'users.last_name')->get();
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        $data['buildings']  = BuildingModel::select('id', 'building_name')->orderBy('building_name', 'asc')->get();

        return view('request_service', $data);
    }

    public function indexSupplier($catSlug, $id) {

//        print_r($id); exit();

        $data['metas'] = get_page_meta_array('Request Service');
        $data['defaultLocation'] = ['id' => '', 'state' => ''];
        $data['categories'] = Categories::getMainCategories();
        $data['subCategories'] = Categories::getSubCategories();
        $data['selectedCategories'] = "";
        $data['selectedSubCategories'] = "";
        $selectedCategories = Categories::getCategoryBySlug($catSlug);
        if (!empty($selectedCategories)) {
            foreach ($selectedCategories as $selectedCategory) {
                $data['selectedCategories'] = $selectedCategory->parent_id;
                $data['selectedSubCategories'] = $selectedCategory->id;
            }
        }
        $data['openly'] = "";
        $data['supplier_id'] = $id;
//        print_r( $data['supplier_id']); exit();

        $data['activeSupplier'] = DB::table('suplier_buyerrel as sb')
                        ->leftjoin('users', 'sb.supplier_id', '=', 'users.id')
                        ->where('sb.buyer_id', 0)
                        ->select('users.id', 'users.first_name', 'users.last_name')->get();
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        return view('request_service', $data);
    }

    public function Save(RequestRequestService $request) {
        $request->merge(array('description' => nl2br($request->get('description'))));
        if (Auth::Guest()) {
//            Session::set("requesServiceValues", $request->except('_token'));
            if ($request->get('existingUser') == 1) {
                $loginDetails = ['email' => $request->get('loginEmail'), 'password' => $request->get('loginPassword'), 'userType' => $request->get('userType')];
                            
                if (Auth::attempt($loginDetails, 0, 1)) {
                    if (Auth::user()->status == 0) {
                        Auth::logout();
                        return redirect('auth/login')
                                        ->withInput(['email' => $request['loginEmail']])
                                        ->withErrors([
                                            'email' => "please verify email before login.",
                        ]);
                    }

                    if (Auth::user()->user_type != 3) {
                        if (Auth::user()->user_type != $request->get('userType')) {
                            Auth::logout();
                            return redirect('auth/login')
                                            ->withInput(['email' => $request['loginEmail']])
                                            ->withErrors([
                                                'userType' => "Invalid user type selected",
                            ]);
                        }
                    }

                } else {
                    return redirect('auth/login')->withInput($request->only('loginEmail'))
                                    ->withErrors(['userType' => "These credentials do not match our records."]);
                }
            } else {
                $this->registrar = new Registrar;

                $validator = $this->registrar->validator($request->all());
                if ($validator->fails()) {
                    $this->throwValidationException($request, $validator);
                }

                Auth::login($this->registrar->create($request->all()), false, $request->get("iAmA"));
            }
//            return redirect("/request-service/save");
        } /*else {*/
        
            $request->merge(array('buyer_id' => Auth::id()));
            if ($request->singleSupplier == null) {
                $supplier1 = "";
                if ($request->asuppliers != null) {
                    for ($i = 0; $i < count($request->asuppliers); $i++) {
                        $supplier1 = $supplier1 . $request->asuppliers[$i] . ',';
                    }
                }
                $request->merge(array('supplier_id' => $supplier1));
            } else {

                $request->merge(array('supplier_id' => $request->singleSupplier));
            }
            
            $building_info = BuildingModel:: select('buildings.city_id', 'buildings.state_id')
                        ->join('users', 'users.building_id', '=', 'buildings.id')
                        ->where ('users.id', Auth::id())->first();
            
            $request->merge(['city' => $building_info->city_id, 'state' => $building_info->state_id]);
            
            if (getSettings('auto_pilot') == 1) {
                $request->merge(array('status' => 1));
                $request_service = ModelRequestService::create($request->except('_token', 'updated_at'));
                if ($request_service->supplier_id) {
                    $supplierArray = explode(",", $request_service->supplier_id);
                    $suppliers = request_to_specificSupplier($supplierArray);
                } elseif ($request_service->list_type == 1) {
                    $query = "SELECT users.id, users.first_name, users.last_name,  users.email users.approval_email from  users , suplier_buyerrel "
                            . "where suplier_buyerrel.supplier_id = users.id and suplier_buyerrel.buyer_id=" . $request_service->buyer_id . " AND FIND_IN_SET(" . $request_service->main_categories
                            . ", users.main_categories) AND FIND_IN_SET(" . $request_service->sub_categories . ", users.sub_categories) and suplier_buyerrel.status=1";
                    $suppliers = DB::select($query);
                } else {
                    $query = "SELECT id, first_name, last_name, service_kilometers, email ,approval_email 
                            FROM users WHERE user_type != 1 AND id != " . $request_service->buyer_id . " AND FIND_IN_SET(" . $request_service->main_categories
                            . ", main_categories) AND FIND_IN_SET(" . $request_service->sub_categories . ", sub_categories) AND FIND_IN_SET("
                            . $request_service->state . ", service_states) AND FIND_IN_SET(" . $request_service->city . ", service_cities)";
                    $suppliers = DB::select($query);
                }
                
                $insertionData = array();
                foreach ($suppliers as $supplier) {
                    $insertionData[] = array("request_id" => $request_service->id, "supplier_id" => $supplier->id);
                    $subscriptions = DB::table('emails_subscription')->where('userid', $supplier->id)->first();

                    if ($subscriptions && $subscriptions->quote_notification) {
                        $email = $supplier->email;
                        $ccemail = $supplier->approval_email;
                        $qoute_invitationN = DB::table('notification')
                                ->where('notificationName', 'qoute_invitation')
                                ->first();
                        $buyer = strtr($qoute_invitationN->content, ["@first_name" => $supplier->first_name, "@last_name" => $supplier->last_name,
                            "@requesturl" => url('project-details/' . $request_service->id),
                        ]);
                        $result_qoute = ['emailbody' => $buyer];
                        Mail::send('emails.quote_invitaion', $result_qoute, function($message) use ($email, $ccemail) {
                            $message->to($email)
                                    ->subject('Invitaion to Quote');
                            if ($ccemail != null)
                                    $message->cc($ccemail);
                            $message->from(SENDER_EMAIL, SENDER_NAME);
                        });
                    }
                }
                DB::table('quotes_invitation')->insert($insertionData);
            } else {

                $request_service = ModelRequestService::create($request->except('_token', 'updated_at'));
            }

            if ($request->file('image') != null) {
//                print_r($request_service);exit();
                $fileName = saveOrReplaceFile("img/requestservice", $request->file('image'), "", $request_service['id'], $request_service['created_at']);
                $request_service->image = $fileName;
                $request_service->image = $fileName;
                $request_service->save();
            }
            
            $userEmail = Auth::user()->email;
            $userAEmail = Auth::user()->approval_email;

            $subscriptions = DB::table('emails_subscription')->where('userid', Auth::id())->first();
            if ($subscriptions && $subscriptions->request_notification) {
                $service_request_createdNotification = DB::table('notification')
                        ->where('notificationName', 'service_request_created')
                        ->first();
                $buyer = strtr($service_request_createdNotification->content, ["@name" => Auth::user()->first_name . " " . Auth::user()->last_name, '@click_here' => url('unsubscribe')]);

                $data = ['emailbody' => $buyer];
                Mail::send('emails.service_created_email', $data, function($message) use ($userEmail, $userAEmail) {
                    $message->to($userEmail)
                            ->subject('Service Created Successfully');
                    if ($userAEmail != null)
                        $message->cc($userAEmail);
                    $message->from(SENDER_EMAIL, SENDER_NAME);
                });
            }
            
            $service_request_created_adminNotification = DB::table('notification')
                    ->where('notificationName', 'service_request_created_emil')
                    ->first();
            
            $buyer = strtr($service_request_created_adminNotification->content, ["@request_id" => $request_service->id]);
            
            $data = ['emailbody' => $buyer];
            Mail::send('emails.service_created_email_admin', $data, function($message) {
                $message->to(getSettings('notification_email'))
                        ->subject('A New Service Created');
                $message->from(SENDER_EMAIL, SENDER_NAME);
            });
            unset($request);
            return redirect('dashboard');
//        }
    }

    public function SaveFromSession() {
        if (Auth::Guest()) {
            return redirect('/');
        } else {
            $request = Session::get("requesServiceValues");
            $request['buyer_id'] = Auth::id();
            if ($request['singleSupplier'] == null) {
                $supplier1 = "";
                if (!empty($request['asuppliers']) && $request['asuppliers'] != null) {
                    for ($i = 0; $i < count($request['asuppliers']); $i++) {
                        $supplier1 = $supplier1 . $request['asuppliers'][$i] . ',';
                    }
                }
                $request['supplier_id'] = $supplier1;
            } else {
                $request['supplier_id'] = $request['singleSupplier'];
            }

            if (getSettings('auto_pilot') == 1) {
                $request->merge(array('status' => 1));
                $request_service = ModelRequestService::create($request);
                Session::forget('requesServiceValues');
                if ($request_service->supplier_id) {
                    
                } elseif ($request_service->list_type == 1) {
                    $query = "SELECT users.id, users.first_name, users.last_name,  users.email users.approval_email from  users , suplier_buyerrel "
                            . "where suplier_buyerrel.supplier_id = users.id and suplier_buyerrel.buyer_id=" . $request_service->buyer_id . " AND FIND_IN_SET(" . $request_service->main_categories
                            . ", users.main_categories) AND FIND_IN_SET(" . $request_service->sub_categories . ", users.sub_categories) and suplier_buyerrel.status=1";
                    $suppliers = DB::select($query);
                } else {
                    $query = "SELECT id, first_name, last_name, service_kilometers, email ,approval_email 
                            FROM users WHERE user_type != 1 AND id != " . $request_service->buyer_id . " AND FIND_IN_SET(" . $request_service->main_categories
                            . ", main_categories) AND FIND_IN_SET(" . $request_service->sub_categories . ", sub_categories) AND FIND_IN_SET("
                            . $request_service->state . ", service_states) AND FIND_IN_SET(" . $request_service->city . ", service_cities)";
                    $suppliers = DB::select($query);
                }
                $supplierArray = explode(",", $request_service->supplier_id);
                $suppliers = request_to_specificSupplier($supplierArray);
                $insertionData = array();
                foreach ($suppliers as $supplier) {
                    $insertionData[] = array("request_id" => $request_service->id, "supplier_id" => $supplier->id);
                    $subscriptions = DB::table('emails_subscription')->where('userid', $supplier->id)->first();
                    if ($subscriptions && $subscriptions->quote_notification) {
                        $email = $supplier->email;
                        $ccemail = $supplier->approval_email;
                        $qoute_invitationN = DB::table('notification')
                                ->where('notificationName', 'qoute_invitation')
                                ->first();
                        $buyer = strtr($qoute_invitationN->content, ["@first_name" => $supplier->first_name, "@last_name" => $supplier->last_name,
                            "@requesturl" => url('project-details/' . $request_service->id),
                        ]);
                        $result_qoute = ['emailbody' => $buyer];
                        Mail::send('emails.quote_invitaion', $result_qoute, function($message) use ($email, $ccemail) {
                            $message->to($email)
                                    ->subject('Invitaion to Quote');
                            if ($ccemail != null)
                                    $message->cc($ccemail);
                            $message->from(SENDER_EMAIL, SENDER_NAME);
                        });
                    }
                }
                DB::table('quotes_invitation')->insert($insertionData);
            } else {

                $request_service = ModelRequestService::create($request);
                Session::forget('requesServiceValues');
            }

            $userEmail = Auth::user()->email;
            $userAEmail = Auth::user()->approval_email;

            $subscriptions = DB::table('emails_subscription')->where('userid', Auth::id())->first();
            if ($subscriptions) {
                if ($subscriptions->request_notification) {
                    $service_request_createdNotification = DB::table('notification')
                            ->where('notificationName', 'service_request_created')
                            ->first();
                    $buyer = strtr($service_request_createdNotification->content, ["@name" => Auth::user()->first_name . " " . Auth::user()->last_name, '@click_here' => url('unsubscribe')]);
                    $data = ['emailbody' => $buyer];
                    Mail::send('emails.service_created_email', $data, function($message) use ($userEmail, $userAEmail) {
                        $message->to($userEmail)
                                ->subject('Service Created Successfully');
                        if ($userAEmail != null)
                                $message->cc($userAEmail);
                        $message->from(SENDER_EMAIL, SENDER_NAME);
                    });
                }
            }
            $service_request_created_adminNotification = DB::table('notification')
                    ->where('notificationName', 'service_request_created_emil')
                    ->first();
            $data = ['emailbody' => $service_request_created_adminNotification->content];
            Mail::send('emails.service_created_email_admin', $data, function($message) {
                $message->to(getSettings('notification_email'))
                        ->subject('A New Service Created');
                $message->from(SENDER_EMAIL, SENDER_NAME);
            });
            if (Auth::user()->status == 0) {
                Auth::logout();
                return redirect('auth/login')
                                ->with('message', 'A verification email has sent to provided email address. Please verify your email address then continue.');
            }
            return redirect('dashboard');
        }
    }

}
