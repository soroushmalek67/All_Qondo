<?php
/*
 * Qondo.ca API
 * TechnologyWisdom.com
 * Phase II - 2017
 * 
 * API KEY: RK8dYHtHqWlWVDdmIrerIIsflODENJ
 *
**/

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Contracts\Auth\Guard;

use Input;

use Auth;

use DB;

use Hash;

use App\Categories;

use App\Http\Requests\RequestRequestService;

use Validator;

use App\ModelRequestService;

use Mail;

use App\Http\Requests\supplierRequest;

use App\Http\Requests\allSupplierlist;

use App\ModelCities;

use App\ModelStates;

use Illuminate\Contracts\Auth\PasswordBroker;

use Illuminate\Support\Facades\File;

use App\Models\BuildingModel;

use Illuminate\Support\Facades\View;

//use Illuminate\Http\File;

/*
++++++++++++++++++++++++++++++++++++++++++++++++

				USER STATUS CODE

++++++++++++++++++++++++++++++++++++++++++++++++

1- Active User

6- User with Building approved

7- User with Building Not Approved

*/

class Api_v2 extends Controller
{
	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;
	/**
	 * The password broker implementation.
	 *
	 * @var PasswordBroker
	 */
	protected $passwords;
	/*
	---------------------------------------------
		FUNCTION:	Validate Data
	---------------------------------------------
	*/
	private function validate_data($data, $rules, $messages)
	{
		$validator = Validator::make($data, $rules, $messages);
	
		if ($validator->fails())
		{
			$error_messages = json_decode($validator->messages());
	
			$error_mess = [];
	
			foreach ($error_messages as $key => $val)
			{
				$error_mess[] = $val;
			}
	
			return $error_mess;
		}
		else
		{
			return false;
		}
	}
	/*
	------------------------------------------
		FUNCTION:	TEST
		
		METHOD:		GET
		
		URL: 		url('api/get-test-user')
		
		PARAMS:		api_key = string|required
	------------------------------------------
	*/
	public function getRegisterUser()
	{
		$data['metas '] = '';
		return view('pages.test_api', $data);
	}
	/*
	---------------------------------------------
		FUNCTION:	Categories List
		
		METHOD:		GET
		
		URL: 		url('api/get-cat-services')
		
		PARAMS:		api_key = string|required
	---------------------------------------------
	*/
	public function GetCatServices()
	{
		$cats = DB::table('category_description')->select("category_id", "name", 'parent_id', "description", "category.slug", "category.category_icon")
	
				->join('category', 'category.id', '=', 'category_description.category_id')
	
				->orderBy('name', 'ASC')->get();
	
		$response['suggestions'] = array();
	
		foreach ($cats as $cat)
		{
			if ($cat->parent_id != 0) 
			{
				$response['suggestions'][] = array("data" => $cat->category_id, "value" => $cat->name, "slug" => $cat->slug, "optionType" => 'category', 'type' => 'service', 'icon' => $cat->category_icon);
			}
			else
			{
				$response['suggestions'][] = array("data" => $cat->category_id, "value" => $cat->name, "slug" => $cat->slug, "optionType" => 'category', 'type' => 'category', 'icon' => $cat->category_icon);
			}
		}
	
		$response['icon_url'] = url('/img/category/category_icons/');
	
		if (!empty($response))
		{
			return response()->json(['Response' => $response, 'Message' => 'Success', 'Status' => true]);
		}
		else
		{
			return response()->json(['Response' => '', 'Message' => 'No record found', 'Status' => fail]);
		}
	}
	/*
	---------------------------------------------
		FUNCTION:	Get Ctegories
		
		METHOD:		GET
		
		URL: 		url('api/categories')
		
		PARAMS:		api_key = string|required
					
	---------------------------------------------
	*/
	public function GetCategories()
	{
		$categories = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
	
						->select("c.id", "c.slug", "c.image", "cd.name", "cd.description")->where('c.parent_id', 0)
	
						->orderBy('c.featured', 'desc')->orderBy('cd.name', 'desc')->get();
	
		return response()->json(['Response' => ["Categories" => $categories], 'Message' => 'Success', 'Status' => true, 'Category_img_ul' => url('/img/category/')]);
	}
	/*
	---------------------------------------------
		FUNCTION:	Sub-Categories List (Services)
		
		METHOD:		GET
		
		URL: 		url('api/get-services')
		
		PARAMS:		api_key = string|required
	---------------------------------------------
	*/
	public function GetServices()
	{
		$cats = DB::table('category_description')->select("category_id", "name", 'parent_id', "description", "category.slug", "category.category_icon")
	
				->join('category', 'category.id', '=', 'category_description.category_id')
	
				->where('parent_id', '!=', 0)
	
				->orderBy('name', 'ASC')->get();
	
		$response['suggestions'] = array();
	
		foreach ($cats as $cat)
		{
			$response['suggestions'][] = array("data" => $cat->category_id, "value" => $cat->name, "optionType" => 'category', 'type' => 'service', 'icon' => $cat->category_icon);
		}
	
		if (!empty($response))
		{
			return response()->json(['Response' => $response, 'Message' => 'Success', 'Status' => true]);
		}
		else
		{
			return response()->json(['Response' => '', 'Message' => 'No record found', 'Status' => false]);
		}
	}
	/*
	---------------------------------------------
		FUNCTION:	Get Sub-Categories
		
		METHOD:		GET
		
		URL: 		url('api/categories/{slug}')
		
		PARAMS:		api_key = string|required
					
					{slug} = string(category_slug)|required
	---------------------------------------------
	*/
	public function GetSubCategories($slug) {
	
		$data = DB::table('category as c')->leftJoin('category as c2', 'c2.id', '=', 'c.parent_id')
	
				->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
	
				->select("c.id", "c.category_icon", "c.slug", "c.image", "cd.name")
	
				->where('c2.slug', $slug)->orderBy('cd.name', 'ASC')->get();
	
		if (!empty($data))
		{
			return response()->json(['Response' => $data, 'Message' => 'Success', 'Status' => true]);
		}
		else
		{
			return response()->json(['Response' => '', 'Message' => 'No record found', 'Status' => false]);
		}
	}
	/*
	---------------------------------------------
		FUNCTION:	User Profile Details
		
		METHOD:		GET
		
		URL: 		url('api/view-profile')
		
		PARAMS:		api_key = string|required
					user_id = numeric|required
	---------------------------------------------
	*/
	public function ViewProfile()
	{
		$use_id = input:: get('user_id');
	
		$data['user_info'] = user::Leftjoin(DB::raw('(SELECT buyer_id, count(*) as total_requests from request_service group by buyer_id) as rs '), 'rs.buyer_id', '=', 'users.id')
								
							->Leftjoin(DB::raw('(SELECT user_id, count(*) as total_reviews from reviews_testimonials group by user_id) as rt '), 'rt.user_id', '=', 'users.id')
							
							->leftJoin('buildings as b' , 'b.id', '=', 'users.building_id')
							
							->join('cities', 'b.city_id', '=', 'cities.id')
							
							->join('provinces', 'b.state_id', '=', 'provinces.id')
							
							->where('users.id', $use_id)
							
							//->select('users.id', 'first_name', 'last_name', 'credit_card_no', 'rs.total_requests', 'rt.total_reviews', 'b.building_name', 'b.Address')
							->select('users.id', 'first_name', 'last_name', DB::raw("CONCAT('************', SUBSTRING(credit_card_no, CHAR_LENGTH(credit_card_no) - 4, 4)) AS credit_card_no"), 'cc_exp_month', 'cc_exp_year', 'cc_cv2_code', 'rs.total_requests', 'rt.total_reviews', 'users.building_id', DB::raw("CONCAT(b.building_name, ', ', b.Address, ', ', cities.name, ', ', provinces.name) AS building_name"))
							
							->get();
	
		$data['user_info']['user_image'] = url('img/users/'.$use_id.'.jpg');
	
		return $data['user_info'];
	}
	/*
	---------------------------------------------
		FUNCTION:	Update User Profile
		
		METHOD:		POST
		
		URL: 		url('api/update-profile')
		
		PARAMS:		api_key = string|required
					user_id = numeric|required
					building_id = numeric|required
					first_name = string|required
					last_name = string
					credit_card_no = numeric
					cc_exp_month = numeric
					cc_exp_year = numeric
					cc_cv2_code = numeric
					avatar = base_64 string
	---------------------------------------------
	*/
	public function UpdateProfile(Request $request)
	{
		$data = input :: all();
		
		if (isset($data['new_building']) && $data['new_building'] == 'y')
		{
			$rules = ['first_name' => 'required'];
		}
		else
		{
			$rules = ['first_name' => 'required', 'building_id' => 'required'];
		}
	
		$messages = ['first_name.required' => 'Name is required'];
	
		$invalid = $this->validate_data($data, $rules, $messages);
	
		if ($invalid != false && count($invalid) > 0)
		{
			return ['Response' => 'Error', 'Messages' => json_encode($invalid), 'Status' => false];
		}
	
		$userId = Input:: get('user_id');
	
		input::merge(["first_name" => input:: get('first_name')]);
	
		input::merge(["last_name" => input:: get('last_name')]);	
		
		if (isset($data['new_building']) && $data['new_building'] == 'y')
		{
			$building_flag = true;
	
			$building_info = BuildingModel::create([
	
								'building_name' => $data['building_name'],
				
								//'lot_number' => $data['lot_number'],
				
								'postal_code' => $data['postal_code'],
				
								//'url' => $data['url'],
				
								'state_id' => $data['state_id'],
				
								'city_id' => $data['city_id'],
				
								'country_id' => 1,
				
								'Address' => $data['Address'],
				
								//'management_company' => $data['management_company']
							]);
	
			input::merge(["building_id" => $building_info->id]);
	
			input::merge(["status" => 7]);
		}
	
		if ($request->get('avatar') != null)
		{
			$avatar = $request->get('avatar');
	
			$avatar = base64_decode($avatar);
	
			$destinationPath = 'img/users/';
	
			$fileName = $userId . '.jpg';// . $extension;
	
			$fileNameWithFolder = $destinationPath . '/' . $fileName;
	
			if (file_put_contents($fileNameWithFolder, $avatar))
			{
	
			}
			else
			{
				return response()->json(['Response' => 'fail', 'Messages' => "There is an error while saving image. Please try  again.", 'Status' => false]);
			}
		}
		
		if(strpos($data['credit_card_no'], '*') === false)
		{
			$user_data = User::where('id', Input:: get('user_id'))
	
					->update(Input::only('first_name', 'last_name', 'credit_card_no', 'cc_exp_month', 'cc_exp_year', 'cc_cv2_code', 'building_id'));
		}
		else
		{
			$user_data = User::where('id', Input:: get('user_id'))
	
					->update(Input::only('first_name', 'last_name', 'cc_exp_month', 'cc_exp_year', 'cc_cv2_code', 'building_id'));
		}
		
		if ($user_data)
		{
			return ['Response' => 'success', 'Messages' => 'Profile updated ', 'Status' => true];
		}
		else
		{
			return ['Response' => 'success', 'Messages' => 'Sorry! There is a problem while updating. Please try again.', 'Status' => true];
		}
	}
	/*
	---------------------------------------------
		FUNCTION:	Register New User
		
		METHOD:		POST
		
		URL: 		url('api/register')
		
		PARAMS:		api_key = string|required
					
					full_name = string|required
					email = email|required
					password = string|required
	
					building_id = numeric|required
					
					-------------------------------
					@if user add new building then:
					-------------------------------
					
					new_building = y
					building_name = string|required
					lot_number = numeric|required
					postal_code = string|required
					url = string
					state_id = numeric
					city_id = numeric
					Address = string
					management_company = string
					Phone = numeric
					onsite_manager = numeric
	---------------------------------------------
	*/
	public function RegisterUser()
	{
		$data = input :: all();
	
		$rules = ['building_id' => 'required', 'email' => 'required|email|max:255|unique:users', 'password' => 'required|min:6', 'full_name' => 'required'];
	
		$messages = ['building_id.required' => 'Building is required'];
	
		$building_flag = false;
	
		$validate_admin	=	User:: select('email')
	
							->where('email', input::get('email'))
	
							->first();
	
		if (empty($validate_admin))
		{
			if (isset($data['new_building']) && $data['new_building'] == 'y')
			{
				$building_flag = true;
	
				$building_info = BuildingModel::create([
	
									'building_name' => $data['building_name'],
					
									//'lot_number' => $data['lot_number'],
					
									'postal_code' => $data['postal_code'],
					
									//'url' => $data['url'],
					
									'state_id' => $data['state_id'],
					
									'city_id' => $data['city_id'],
					
									'country_id' => 1,
					
									'Address' => $data['Address'],
					
									//'management_company' => $data['management_company']
								]);
	
				input::merge(["building_id" => $building_info->id]);
	
				input::merge(["status" => 7]);
			}
			else
			{
				input::merge(['status' => 0]);
			}
	
			$validator = Validator::make(input::all(), $rules, $messages);
	
			if ($validator->fails())
			{
				$error_messages = json_decode($validator->messages());
	
				$error_mess = [];
	
				foreach ($error_messages as $key => $val)
				{
					$error_mess[] = $val;
				}
				
				return ['Response' => 'Error', 'Messages' => $error_mess, 'Status' => false];
			}
	
			input::merge(["password" => bcrypt(input::get('password'))]);
	
			input::merge(["user_type" => 1]);
	
			$full_name = input:: get('full_name');
	
			$full_name = explode(' ', $full_name);
	
			input::merge(["first_name" => $full_name[0]]);
	
			$last_name = '';
	
			for ($cun = 1; $cun < count($full_name); $cun++)
			{
				$last_name .= $full_name[$cun];
			}
			
			input::merge(["last_name" => $last_name]);
	
			$user_data = User:: create(Input::only('first_name', 'last_name', 'email', 'building_id', 'status', 'user_type', 'password'));
	
			if ($user_data)
			{
	
				$emails_subscription_checker = DB::table('emails_subscription')->where('userid', $user_data->id)->first();
	
				$registerNotification = DB::table('notification')
	
										->where('notificationName', 'register')
	
										->first();
	
				$buyer = strtr($registerNotification->content, [
							"@username" => input:: get('full_name'),
			
							"@useremail" => input::get('email'), "@urlconfirmemail" => url("auth/confirm/$user_data->token"),
			
							"@siteurl" => url("auth/login")
						]);
	
				$result = ['emailbody' => $buyer];
	
				if (!$building_flag)
				{
					$flag = Mail::send('emails.user_confirm', $result, function($message) use ($user_data)
							{
								$message->to($user_data->email)
								
								->subject('Successfully Registered');
		
								$message->from(SENDER_EMAIL, SENDER_NAME);
							});
				}
	
				$registered_emailNotification = DB::table('notification')
	
				->where('notificationName', 'user_create')
	
				->first();
	
				$buyer = strtr($registered_emailNotification->content, [
					"@firstname" => $user_data->first_name,
					
					'@lastname' => $user_data->last_name,
	
					"@email" => $user_data->email,
					
					"@password" => input:: get('password'),
	
					"@loginurl" => url("auth/login")
				]);
	
				$result1 = ['emailbody' => $buyer];
	
				Mail::send('emails.registered_email_admin', $result1, function($message)
				{
					$message->to(getSettings('notification_email'))
	
					->subject('New Registration');
	
					$message->from(SENDER_EMAIL, SENDER_NAME);
				});
	
				if ($building_flag)
				{
					$message = 'Your building is currently being approved. Once approved, you,ll receive a conformation email and an account activation link. ';
				}
				else
				{
					$message = 'A verification message was sent to your email address. Please verify your email and then continue';
				}
				
				return response()->json(['Response' => 'success', 'Message' => $message, 'Status' => true]);
			}
			else
			{
				return response()->json(['Response' => 'error', 'Message' => 'There was problem while create user', 'Status' => false]);
			}
		}
		else
		{
			return response()->json(['Response' => 'error', 'Message' => 'Email already exist', 'Status' => false]);
		}
	}
	/*
	---------------------------------------------
		FUNCTION:	Login User
		
		METHOD:		POST
		
		URL: 		url('api/login')
		
		PARAMS:		api_key = string|required
					
					email = email|required
					password = string|required
	---------------------------------------------
	*/
	public function postLogin(Request $request)
	{
		$validate_admin = User::where(function ($query)
		{
			$query->where('user_type', '1')
	
			->orWhere('user_type', '3');
	
		})->where('email', Input::get('email'))
	
		->first();
	
		if ($validate_admin && Hash::check(Input::get('password'), $validate_admin->password))
		{
			if ($validate_admin->status == 0)
			{
				return ['Response' => 'Error', 'Message' => 'Please verify email before login.', 'Status' => false];
			}
			else if ($validate_admin->status == 7)
			{
				return ['Response' => 'Error', 'Message' => 'Your building is currently being approved. Once approved, you,ll receive a conformation email and an account activation link', 'Status' => false];
			}
			
			$categories = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
	
							->select("c.id", "c.slug", "c.image", "c.category_icon", "cd.name", "cd.description")->where('c.parent_id', 0)
	
							->orderBy('c.featured', 'desc')->orderBy('cd.name', 'asc')->get();
	
			$data['Response'] = ['User_Profile' => $validate_admin, "Categories" => $categories];
	
			$data['Message'] = "success";
	
			$data['Status'] = true;
	
			$data['Category_img_ul'] = url('/img/category/category_icons/');
	
			$data['category_icon'] = 'cat_def.png';
	
			return response()->json($data);
		}
		else
		{
			$data['Response'] = 'error';
	
			$data['Message'] = "Please provide valid information";
	
			$data['Status'] = false;
	
			return response()->json($data);
		}
	}
	/*
	---------------------------------------------
		FUNCTION:	Contractors List
		
		METHOD:		GET
		
		URL: 		url('api/supplierlist')
		
		PARAMS:		api_key = string|required
					
					user_id = numeric|required
					main_categories = (numeric/array)
					sub_categories = (numeric/array)
	---------------------------------------------
	*/
	public function supplierlist(Request $request)
	{
		$userid = $request->get('user_id');
	
		if ($request->get('main_categories') != null)
		{
			//$maincat=implode(",", $request->get('main_categories'));
	
			$maincat = $request->get('main_categories');
	
			$data['searchmain'] = $request->get('main_categories');
		}
		else
		{
			$maincat = "0";
	
			$data['searchmain'] = " ";
		}
	
		if ($request->get('sub_categories') != null)
		{
			$childcat = $request->get('sub_categories');
	
			$data['searchchild'] = $request->get('sub_categories');
	
		}
		else
		{
			$childcat = "0";
	
			$data['searchchild'] = "";
		}
	
		$data['categories'] = Categories::getMainCategories();
	
		$data['Subcategories'] = Categories::getChildCategoriesByID($maincat);
	
		$data['AllSubCategories'] = Categories::getSubCategories();
	
		$data['userDetails'] = User::find($userid);
	
		$supplierlists = DB::table('suplier_buyerrel')
	
						->leftjoin('users as u', 'u.id', '=', 'suplier_buyerrel.supplier_id')
	
						->leftjoin('provinces as p', 'p.id', '=', 'u.state')
	
						->leftjoin('cities as city', 'city.id', '=', 'u.city')
	
						->where('buyer_id', $userid)
	
						->where('added_by', 0)
			
						->where(function ($query) use ($childcat, $maincat)
						{
							if (($childcat) != 0)
							{
								$query->whereRaw('FIND_IN_SET(' . $childcat . ',u.sub_categories)');
							}	
		
							if ($maincat != 0)
							{
								$query->whereRaw('FIND_IN_SET(' . $maincat . ', u.main_categories)');
							}
						})
	
						->select('u.*', 'suplier_buyerrel.show_email', 'suplier_buyerrel.status as activation', 'p.name as provinceName', 'city.name as cityName')
	
						->orderBy('first_name', 'desc')
	
						->get();
	
		$suppliers = [];
	
		if (!empty($supplierlists))
		{
			foreach ($supplierlists as $supplierlist)
			{
				if (is_null($supplierlist->cityName))
				{
					$supplierlist->cityName = '';
				}
	
				$suppliers [] = $supplierlist;
			}
			
			return response()->json(['Response' => $suppliers, 'Message' => 'Success', 'Status' => true]);
		}
		else
		{
			return response()->json(['Response' => $suppliers, 'Message' => 'No record found', 'Status' => false]);
		}
	}
	/*
	---------------------------------------------
		FUNCTION:	Create New Request
		
		METHOD:		POST
		
		URL: 		url('api/supplierlist')
		
		PARAMS:		api_key = string|required
					
					user_id = numeric|required
					main_categories = (numeric/array)
					sub_categories = (numeric/array)
	---------------------------------------------
	*/
	public function RequestService(Request $request)
	{
		$request->merge(array('estimated_budget' => strtolower($request->get('estimated_budget'))));
		
		//Muaawiya's
		
		$rules = ['title' => 'required', 'main_categories' => 'required', 'sub_categories' => 'required', 'description' => 'required', 'when_need_it' => 'required', 'user_id' => 'required', 'estimated_budget' => 'required|alpha|in:' . implode(",", array("small","medium","large"))];
	
		//$rules = ['title' => 'required', 'main_categories' => 'required|numeric', 'sub_categories' => 'required|numeric', 'description' => 'required', 'state' => 'required|numeric', 'city' => 'required|numeric', 'estimated_budget' => 'required|alpha|in:' . implode(",", array("small","medium","large")), 'when_need_it' => 'required|numeric', 'user_id' => 'required|numeric'];
	
		$validator = Validator::make(input::all(), $rules);
	
		if($validator->fails())
		{
			$error_messages = json_decode($validator->messages());
	
			$error_mess = [];
	
			foreach ($error_messages as $key => $val)
			{
				$error_mess[] = $val;
			}
	
			return ['Response' => 'Error', 'Message' => $error_mess, 'Status' => false];
	
		}
	
		//END Muaawiya's
	
			$user_id = $request->get('user_id');
	
			$building_detail = BuildingModel:: select('buildings.id', 'buildings.city_id', 'buildings.state_id', 'buildings.status')
	
								->join('users', 'users.building_id', '=', 'buildings.id')
	
								->where('users.id', $user_id)->first();
								
			if($building_detail->status == 0)
			{
				return response()->json(['Response' => 'Error', 'Message' => "Your building is being approved. Once approved, you can request a service.", 'Status' => false]);
			}
	
			$request->merge(array('description' => nl2br($request->get('description'))));
	
			$request->merge(array('city' => $building_detail->city_id));
	
			$request->merge(array('state' => $building_detail->state_id));
	
			$request->merge(array('buyer_id' => $user_id));
	
			if ($request->singleSupplier == null)
			{
				$supplier1 = "";
	
				if ($request->asuppliers != null)
				{
					for ($i = 0; $i < count($request->asuppliers); $i++)
					{
						$supplier1 = $supplier1 . $request->asuppliers[$i] . ',';
					}
				}
	
				$request->merge(array('supplier_id' => $supplier1));
			}
			else
			{
				$request->merge(array('supplier_id' => $request->singleSupplier));
			}
	
			if (getSettings('auto_pilot') == 1)
			{
				$request->merge(array('status' => 1));
	
				$request_service = ModelRequestService::create($request->except('_token', 'updated_at'));
	
				if ($request_service->supplier_id)
				{    
				
				}
				elseif ($request_service->list_type == 1) {
	
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
	
	
	
				$request_service = ModelRequestService::create($request->except('_token', 'updated_at'));
	
			}
	
	
	
			if ($request->get('image') != null) {
	
	
	
				$data = $request->get('image');
	
				list($extension, $data) = explode(';', $data);
	
				list(, $data) = explode(',', $data);
	
				list(, $extension) = explode('/', $extension);
	
				$data = base64_decode($data);
	
	
	
				$destinationPath = 'img/requestservice';
	
				$makePathForDates = true;
	
				$filePrefix = $request_service['id'];
	
				$pathDate = $request_service['created_at'];
	
	
	
				if ($makePathForDates) {
	
					if (is_null($pathDate)) {
	
						$pathDate = date('Y-m-d');
	
					}
	
					$folderStructure = "/" . date('Y', strtotime($pathDate)) . "/" . date('n', strtotime($pathDate)) . "/" . date('d', strtotime($pathDate));
	
					$destinationPath .= $folderStructure;
	
				}
	
				if (!is_dir($destinationPath)) {
	
					// dir doesn't exist, make it
	
	//                         mkdir($destinationPath);
	
					File::makeDirectory($destinationPath, 0777, true);
	
				}
	
	
	
				$fileName = $filePrefix . "_" . rand(11111, 99999) . '.' . $extension;
	
				$fileNameWithFolder = $destinationPath . '/' . $fileName;
	
	
	
				if (file_put_contents($fileNameWithFolder, $data)) {
	
					//                    $fileName = saveOrReplaceFile("img/requestservice", $request->file('image'), "", $request_service['id'], $request_service['created_at']);
	
					$request_service->image = $fileName;
	
					$request_service->save();
	
				} else {
	
					return response()->json(['Response' => 'fail', 'Message' => "There is an error while saving image. Please try  again.", 'Status' => false]);
	
				}
	
			}
	
	
	
			$user_info = User:: where('id', $user_id)
	
					->first();
	
			$userEmail = $user_info->email;
	
			// $userAEmail = $user_info->approval_email;
	
	
	
			$subscriptions = DB::table('emails_subscription')->where('userid', $user_id)->first();
	
	
	
	
	
			if ($subscriptions && $subscriptions->request_notification) {
	
				$service_request_createdNotification = DB::table('notification')
	
						->where('notificationName', 'service_request_created')
	
						->first();
	
				$buyer = strtr($service_request_createdNotification->content, ["@name" => $user_info->first_name . " " . $user_info->last_name, '@click_here' => url('unsubscribe')]);
	
	
	
				$data = ['emailbody' => $buyer];
	
	
	
				//email to contractors
	
				Mail::send('emails.service_created_email', $data, function($message) use ($userEmail) {
	
					$message->to($userEmail)
	
							->subject('Service Created Successfully');
	
	
	
					$message->from(SENDER_EMAIL, SENDER_NAME);
	
				});
	
				//end email
	
			}
	
	
	
			//email to admin
	
	
	
			$service_request_created_adminNotification = DB::table('notification')
	
					->where('notificationName', 'service_request_created_emil')
	
					->first();
	
	
	
			$buyer = strtr($service_request_created_adminNotification->content, ["@request_id" => $request_service->id]);
	
	
	
			$data = ['emailbody' => $buyer];
	
			Mail::send('emails.service_created_email_admin', $data, function($message) {
	
				$message->to(getSettings('notification_email'))
	
	//            $message->to('zafar.hayat151@gmail.com')
	
						->subject('A New Service Created');
	
				$message->from(SENDER_EMAIL, SENDER_NAME);
	
			});
	
			//end admin email
	
			return response()->json(['Response' => 'success', 'Message' => 'Service requested successfully.', 'Status' => true]);
	
			//        }
	
		}
	/*
	------------------------------------------
		FUNCTION:	Active Suppliers
		
		METHOD:		GET
		
		URL: 		url('api/get-test-user')
		
		PARAMS:		api_key = string|required
	------------------------------------------
	*/
	public function GetactiveSuppliers()
	{
	
	
	
			$subCategoryids = Input::get('subCategoryid');
	
	//          $supplierCities = Input::get('supplierCities');
	
			$user_id = Input::get('user_id');
	
	
	
			$city_info = BuildingModel:: select('buildings.city_id')
	
							->join('users', 'users.building_id', '=', 'buildings.id')
	
							->where('users.id', $user_id)->first();
	
	
	
			//Get all suppliers
	
			$supplierlists = DB::table('users as u')
	
					->join('provinces as p', 'p.id', '=', 'u.state')
	
					->join('cities as city', 'city.id', '=', 'u.city')
	
					->leftjoin(DB::raw('(SELECT user_id, AVG(stars) as rating FROM reviews_testimonials WHERE aprove = 1 group by user_id) as re'), 're.user_id', '=', 'u.id')
	
	//                ->leftjoin(DB::raw("(SELECT supplier_id, buyer_id  FROM suplier_buyerrel WHERE buyer_id = $user_id) as su"), 'su.buyer_id', '=', 'u.id')
	
					->where('u.city', $city_info->city_id)
	
					->whereRaw(('FIND_IN_SET( ' . $subCategoryids . ',u.sub_categories)'))
	
					->where('added_by', 0)
	
	//                    ->where('aprove', 1)
	
					->where(function($quey) {
	
						$quey->where('u.user_type', 2)
	
						->orWhere('u.user_type', 3);
	
					})
	
					->whereNotIn('u.id', function($query) use ($user_id) {
	
						$query->select('supplier_id')
	
						->from('suplier_buyerrel')
	
						->where('buyer_id', $user_id);
	
					})
	
					->select('u.*', 're.rating', 'p.name as provinceName', 'city.name as cityName')
	
					->orderBy('first_name', 'desc')
	
					->groupBy('u.id')
	
					->get();
	
	
	
	
	
			//Get select suppliers
	
			$data = DB::table('suplier_buyerrel as sb')
	
					->leftjoin('users AS u', 'sb.supplier_id', '=', 'u.id')
	
					->leftjoin('provinces as p', 'p.id', '=', 'u.state')
	
					->leftjoin('cities as city', 'city.id', '=', 'u.city')
	
					->leftjoin(DB::raw('(SELECT user_id, AVG(stars) as rating FROM reviews_testimonials WHERE aprove = 1 group by user_id) as re'), 're.user_id', '=', 'u.id')
	
	//                        ->leftjoin('reviews_testimonials as re', 're.user_id', '=', 'u.id')
	
					->select('u.*', 're.rating', 'p.name as provinceName', 'city.name as cityName')
	
					->Where('sb.buyer_id', $user_id)
	
					->whereRaw(('FIND_IN_SET( ' . $subCategoryids . ',u.sub_categories)'))
	
	//                        ->whereRaw (('FIND_IN_SET( '. $supplierCities . ',u.service_cities)'))
	
					->where('sb.status', 1)
	
					->where('u.added_by', 0)
	
	//                ->where('u.city', $city_info->city_id)
	
	//                        ->where('re.aprove', 1)
	
					->orderBy('u.business_name', 'asc')
	
					->groupBy('u.id')
	
					->get();
	
	
	
	
	
			$all_suppliers = [];
	
			$selected_suppliers = [];
	
	
	
			if (!empty($supplierlists)) {
	
				foreach ($supplierlists as $supplierlist) {
	
					if (is_null($supplierlist->cityName)) {
	
						$supplierlist->cityName = '';
	
					}
	
					if (is_null($supplierlist->rating)) {
	
						$supplierlist->rating = 0;
	
					}
	
					if (!empty(($supplierlist->created_at))) {
	
						$supplierlist->company_logo = getFolderStructureByDate($supplierlist->created_at) . '/' . $supplierlist->company_logo;
	
					}
	
					$supplierlist->selected = false;
	
					$all_suppliers [] = $supplierlist;
	
				}
	
			}
	
			if (!empty($data)) {
	
				foreach ($data as $selected_supplier) {
	
					if (is_null($selected_supplier->cityName)) {
	
						$supplierlist->cityName = '';
	
					}
	
					if (is_null($selected_supplier->rating)) {
	
						$selected_supplier->rating = 0;
	
					}
	
					if (!is_null(($selected_supplier->created_at))) {
	
						$selected_supplier->company_logo = getFolderStructureByDate($selected_supplier->created_at) . '/' . $selected_supplier->company_logo;
	
					}
	
					$selected_supplier->selected = true;
	
					$selected_suppliers [] = $selected_supplier;
	
				}
	
			}
	
	
	
			if (!empty($data) || !empty($supplierlists))
	
				return response()->json(['Response' => ["company_logo_url" => 'img/compay_logos/', 'selected_contractor' => $selected_suppliers, 'all_contractor' => $all_suppliers], 'Message' => 'Success', 'Status' => true]);
	
			else {
	
				return response()->json(['Response' => 'error', 'Message' => "We're currently finding the perfect contractors, please check back later!.", 'Status' => false]);
	
			}
	
	}
	/*
	------------------------------------------
		FUNCTION:	Reset Password
		
		METHOD:		GET
		
		URL: 		url('api/get-test-user')
		
		PARAMS:		api_key = string|required
	------------------------------------------
	*/
	public function ResetPasswordRequest(Request $request, PasswordBroker $passwords)
	{
			$this->passwords = $passwords;
	
	//		$this->validate($request, ['email' => 'required|email']);
	
			$response = $this->passwords->sendResetLink($request->only('email'), function($m) {
	
				$m->subject($this->getEmailSubject())->from(SENDER_EMAIL, SENDER_NAME);
	
			});
	
	
	
			switch ($response) {
	
				case PasswordBroker::RESET_LINK_SENT:
	
					return response()->json(['Response' => 'success', 'Message' => 'Password recovery link has been send to your email address', 'Status' => true]);
	
					exit;
	
	
	
				case PasswordBroker::INVALID_USER:
	
					return response()->json(['Response' => 'error', 'Message' => "We can't find a user with that e-mail address", 'Status' => false]);
	
					exit;
	
			}
	
		}
	/*
	------------------------------------------
		FUNCTION:	TEST
		
		METHOD:		GET
		
		URL: 		url('api/get-test-user')
		
		PARAMS:		api_key = string|required
	------------------------------------------
	*/
	protected function getEmailSubject()
	{
	
			return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
	
	}
	/*
	------------------------------------------
		FUNCTION:	TEST
		
		METHOD:		GET
		
		URL: 		url('api/get-test-user')
		
		PARAMS:		api_key = string|required
	------------------------------------------
	*/
	public function uploadimage(Request $request)
	{
			$data = $request->get('image');
	
	//            $data = 'data:image/png;base64,AAAFBfj42Pj4';
	
	
	
			list($extension, $data) = explode(';', $data);
	
			list(, $data) = explode(',', $data);
	
			list(, $extension) = explode('/', $extension);
	
			$data = base64_decode($data);
	
	
	
			$destinationPath = 'img/requestservice';
	
			$makePathForDates = true;
	
			$filePrefix = '12';
	
			$pathDate = null;
	
	
	
			if ($makePathForDates) {
	
				if (is_null($pathDate)) {
	
					$pathDate = date('Y-m-d');
	
				}
	
				$folderStructure = "/" . date('Y', strtotime($pathDate)) . "/" . date('n', strtotime($pathDate)) . "/" . date('d', strtotime($pathDate));
	
				$destinationPath .= $folderStructure;
	
			}
	
			if (!is_dir($destinationPath)) {
	
				// dir doesn't exist, make it
	
	//                 mkdir($destinationPath);
	
				File::makeDirectory($destinationPath, 0777, true);
	
			}
	
	
	
			$fileName = $destinationPath . '/' . $filePrefix . "_" . rand(11111, 99999) . '.' . $extension;
	
	
	
			if (file_put_contents($fileName, $data))
	
				return response()->json(['Response' => 'success', 'Message' => "success", 'Status' => true]);
	
			else
	
				return response()->json(['Response' => 'error', 'Message' => "fail", 'Status' => false]);
	
	}
	/*
	------------------------------------------
		FUNCTION:	TEST
		
		METHOD:		GET
		
		URL: 		url('api/get-test-user')
		
		PARAMS:		api_key = string|required
	------------------------------------------
	*/
	public function GetBuildings()
	{
			//$buildinng_list = BuildingModel:: all();
			
			$buildinng_list = DB::table('buildings')
								->join('cities', 'buildings.city_id', '=', 'cities.id')
								->join('provinces', 'buildings.state_id', '=', 'provinces.id')
								->select('buildings.id', DB::raw("CONCAT(buildings.building_name, ', ', buildings.Address, ', ', cities.name, ', ', provinces.name) AS building_name"))
								->where('buildings.status', '1')
								->get();
								
			/*$buildinng_list = DB::table('buildings')
								//->join('cities', 'buildings.city_id', '=', 'cities.id')
								//->join('provinces', 'buildings.state_id', '=', 'provinces.id')
								->select('buildings.id', 'building_name')
								->where('buildings.status', '1')
								->get();*/
	
			if (!is_null($buildinng_list))
			{
				return ['Response' => ['buildings_list' => $buildinng_list], 'Message' => 'Success', 'Status' => true];
			}
			else
			{
				return ['Response' => 'Fail', 'Message' => 'Sorry! We could not find any building.', 'Status' => false];
			}
	
	}
		
	//Muaawiya starts here
	
	
	/*
	------------------------------------------
		FUNCTION:	TEST
		
		METHOD:		GET
		
		URL: 		url('api/get-test-user')
		
		PARAMS:		api_key = string|required
	------------------------------------------
	*/
	public function getRequestList($id)
	{
	
	
	
			$user = User::find($id);
	
	
	
			if (!is_null($user)) {
	
				$user_info = user::Leftjoin(DB::raw('(SELECT buyer_id, count(*) as total_requests from request_service group by buyer_id) as rs '), 'rs.buyer_id', '=', 'users.id')
								
							->Leftjoin(DB::raw('(SELECT user_id, count(*) as total_reviews from reviews_testimonials group by user_id) as rt '), 'rt.user_id', '=', 'users.id')
							
							->where('users.id', $user->id)
							
							->get();
							
				$requests = $user->requestedServices()
	
								->leftJoin(DB::raw('(SELECT request_id, count(id) as quotesTotal FROM quotes group by request_id) as q'), 'q.request_id', '=', 'request_service.id')
	
								->leftJoin(DB::raw('(SELECT id, CONCAT(first_name, " ", last_name) as buyer_name FROM users) as u'), 'u.id', '=', 'request_service.buyer_id')
	
								//->join('users', 'users.id', '=', 'request_service.buyer_id')
	
								->select('request_service.*', 'q.quotesTotal', 'u.buyer_name')->orderBy('id', 'desc')->get()->toArray();
	
	
	
				if (!empty($requests)) {
	
					return ['Response' => ['request_list' => $requests, 'user_info' => $user_info], 'Message' => 'Success', 'Status' => true];
	
				} else {
	
	
	
					return ['Response' => 'Fail', 'Message' => 'Sorry! We could not find any request by this user.', 'Status' => false];
	
				}
	
			} else {
	
	
	
				return ['Response' => 'Fail', 'Message' => 'Sorry! We could not find user.', 'Status' => false];
	
			}
	
	}
	/*
	------------------------------------------
		FUNCTION:	TEST
		
		METHOD:		GET
		
		URL: 		url('api/get-test-user')
		
		PARAMS:		api_key = string|required
	------------------------------------------
	*/
	public function getImagesHowItWorks() {
	
			
	
			$images = ['slide_1.png', 'slide_2.png', 'slide_3.png', 'slide_4.png'];
	
	
	
			$url = ['s1' => url('/img/how-it-works/s1/'), 's2' => url('/img/how-it-works/s2/'), 's3' => url('/img/how-it-works/s3/')];
	
	
	
			return ['Response' => ['images' => $images, 'url' => $url], 'Message' => 'Success', 'Status' => true];
	
		}
	
	
	
		public function getStates()
	
		{
	
			$country_id = 1;
	
			$states_list = ModelStates::where('country_id', '=', $country_id)->get();
	
			
	
			if (!is_null($states_list)) {
	
				return ['Response' => ['states_list' => $states_list], 'Message' => 'Success', 'Status' => true];
	
			} else {
	
	
	
				return ['Response' => 'Fail', 'Message' => 'Sorry! We could not find any state for this country.', 'Status' => false];
	
			}
	
	}
	/*
	------------------------------------------
		FUNCTION:	TEST
		
		METHOD:		GET
		
		URL: 		url('api/get-test-user')
		
		PARAMS:		api_key = string|required
	------------------------------------------
	*/
	public function getCities($state_id)
	
		{
	
			$city_list = ModelCities::where('state', '=', $state_id)->get();
	
			
	
			if (!is_null($city_list)) {
	
				return ['Response' => ['city_list' => $city_list], 'Message' => 'Success', 'Status' => true];
	
			} else {
	
	
	
				return ['Response' => 'Fail', 'Message' => 'Sorry! We could not find any city for this state.', 'Status' => false];
	
			}
	
	} 
	/*
	------------------------------------------
		FUNCTION:	TEST
		
		METHOD:		GET
		
		URL: 		url('api/get-test-user')
		
		PARAMS:		api_key = string|required
	------------------------------------------
	*/	
	public function PrivacyPolicy() {
	
			$data['metas'] = get_page_meta_array('Privacy Policy');
	
			//$response = view('api.privacy_policy', $data);
	
			$view = View::make('api.privacy_policy', $data);
	
			$response = $view->render();
	
			return ['Response' => $response, 'Message' => 'Success', 'Status' => true];
	
	}
	
	//Muaawiya ends here
}



?>