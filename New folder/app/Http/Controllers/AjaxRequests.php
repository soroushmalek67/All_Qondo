<?php

namespace App\Http\Controllers;

use Mail;
use App\ModelCities;
use Input;
use DB;
use Auth;
use App\User;
use App\Categories;
use App\Models\BuildingModel;

class AjaxRequests extends Controller {

    public function GetCities() {
        $statesids = Input::get("stateid");
        if (!is_array($statesids)) {
            $statesids = [$statesids];
        }
        return ModelCities::whereIn('cities.state', $statesids)->leftJoin('provinces as s', 's.id', '=', 'cities.state')
                        ->select('cities.id', 'cities.name', 's.name as parentName')->orderBy('s.name', "ASC")->orderBy('cities.name', "ASC")->get();
    }

    public function AutoComplete() {
        $cats = DB::table('category_description')->select("category_id", "name" ,   'parent_id', "description")
                 ->join('category', 'category.id', '=', 'category_description.category_id')
                    ->where('name', "LIKE", "%" . Input::get('query') . "%")
                        ->orderBy('name', 'ASC')->get();

        $companies = User::select("id", "business_name")->where('business_name', "LIKE", "%" . Input::get('query') . "%")
                        ->where(function ($query) {
                            $query->where('user_type', 3)->orWhere('user_type', 2);
                        })->where(function ($query) {
                    $query->where('users.status', 1)->orWhere('users.status', 6);
                })->orderBy('business_name', 'ASC')->get();

        $cities = ModelCities::select("id", "name")->where('name', "LIKE", "%" . Input::get('query') . "%")
                        ->orderBy('name', 'ASC')->get();

        $response['suggestions'] = array();
        foreach ($cats as $cat) {
            
            if($cat->parent_id != 0){
                $response['suggestions'][] = array("data" => $cat->category_id, "value" => $cat->name, "optionType" => 'category' ,'type'=>'service');
            }else{
                $response['suggestions'][] = array("data" => $cat->category_id, "value" => $cat->name, "optionType" => 'category','type'=>'category');
            }
            
        }
        foreach ($companies as $company) {
            $response['suggestions'][] = array("data" => $company->id, "value" => $company->business_name, "optionType" => 'company');
        }
        foreach ($cities as $city) {
            $response['suggestions'][] = array("data" => $city->id, "value" => $city->name, "optionType" => 'city');
        }
        return $response;
    }
     public function HomePageAutoCom() {
        $cats = DB::table('category_description')->select("category_id", "name" , 'parent_id', "description")
                ->join('category', 'category.id', '=', 'category_description.category_id')
                ->where('name', "LIKE", "%" . Input::get('query') . "%")
                        ->orderBy('name', 'ASC')->get();

       

        $response['suggestions'] = array();
        foreach ($cats as $cat) {
            
            if($cat->parent_id != 0){
                $response['suggestions'][] = array("data" => $cat->category_id, "value" => $cat->name, "optionType" => 'category' ,'type'=>'service');
            }else{
                $response['suggestions'][] = array("data" => $cat->category_id, "value" => $cat->name, "optionType" => 'category','type'=>'category');
            }
            
        }
        
        return $response;
    }
     public function GetBuildings() {
        $buildings = DB::table('buildings')->select("id", "building_name", "Address", "status")->where('status', '1')->where('building_name', "LIKE", "%" . Input::get('query') . "%")
                    ->orWhere('Address', "LIKE", "%" . Input::get('query') . "%")
                        ->orderBy('building_name', 'ASC')->get();

        $response['suggestions'] = array();
        foreach ($buildings as $building) {
            if($building->status == 1)
			{
				$response['suggestions'][] = array("data" => $building->id, "value" => $building->Address.', '.$building->building_name);
			}
        }
        
        return $response;
    }

    public function getCompany() {
        

        $companies = User::select("id", "business_name")->where('business_name', "LIKE", "%" . Input::get('query') . "%")
//                        ->where(function ($query) {
//                            $query->where('user_type', 3)->orWhere('user_type', 2);})
                        ->where(function ($query) {
                            $query->where('users.status', 1)/*->orWhere('users.status', 6)*/;})
                        ->orderBy('business_name', 'ASC')->get();
                
//                printr($companies);exit;
        $response['suggestions'] = array();
        
        foreach ($companies as $company) {
           $response['suggestions'][] = array("data" => $company->id, "value" => $company->business_name, "optionType" => 'company');    
        }
//         print_r($companies); exit();
        return $response;
    }

    public function GetSubCategories() {
        $categoriesids = Input::get('categoryid');
        if (is_array($categoriesids)) {
            return Categories::getChildCategoriesByIDs($categoriesids);
        } else {
            return Categories::getChildCategoriesByID($categoriesids);
        }
    }

     public function GetactiveSuppliers() {
         
          $subCategoryids = Input::get('subCategoryid');
          $supplierCities = Input::get('supplierCities');
//           return DB::table('users AS u')
//                ->leftJoin('cities as city','u.city','=','city.id')
//                   ->leftjoin('suplier_buyerrel as sb','sb.supplier_id','=','u.id')
//                ->leftJoin('category_description as cd', DB::raw('FIND_IN_SET(cd.category_id, "' . $subCategoryids . '")'), DB::raw(''), DB::raw(''))
//                        ->select('u.id', DB::raw('CONCAT(u.business_name, " ",  "(", cd.name, " , ", city.name, ")") AS name'), DB::raw('GROUP_CONCAT(cd.name)'))
//                        ->Where('u.id',Auth::id())
//                        ->where('sb.status',1)
//                
////                                ->Where('u.city',$cities)
//                                ->groupBy('u.id')->get();
         
           return DB::table('suplier_buyerrel as sb')
//                        ->leftJoin('cities as city','u.city','=','city.id')
                        ->leftjoin('users AS u','sb.supplier_id','=','u.id')
                        ->select('u.id','u.business_name as name')
                        ->Where('sb.buyer_id',Auth::id())
                        ->whereRaw (('FIND_IN_SET( '. $subCategoryids . ',u.sub_categories)'))
                        ->whereRaw (('FIND_IN_SET( '. $supplierCities . ',u.service_cities)'))
                        ->where('sb.status',1)
                        ->where('u.added_by',0)
//                        ->Where('u.city',$supplierCities)
                        ->get();
     }
     public function GetselectedSuppliers() {

            $subCategoryids = Input::get('subCategoryid');

         
            return DB::table('suplier_buyerrel as sb')
                       
                        ->leftjoin('users AS u','sb.supplier_id','=','u.id')
->Join('cities as city','u.city','=','city.id')
                        ->select('u.id','u.business_name as name')
                        ->Where('sb.buyer_id',Auth::id())
                        ->whereRaw (('FIND_IN_SET( '. $subCategoryids . ',u.sub_categories)'))
                       // ->whereRaw (('FIND_IN_SET( '. $supplierCities . ',u.service_cities)'))
                        ->where('sb.status',1)
                        ->where('u.added_by',0)
                        //->Where('u.city',$supplierCities)
                        ->get();
     }
    
     
     
     

          public function getSuppliers() {
        $cities = 0;
        $subCategoryids = Input::get('subCategoryid');
        $cities= Input::get('supplierCities');
        
        
        
        if (!Input::has('subCategoryid')) {
            
            if(Input::has('supplierCities')){
                
                
         return  DB::table('users AS u')
                ->leftJoin('cities as city','u.city','=','city.id')
//                ->leftJoin('category_description as cd','u.city','=','city.id')
                 ->leftJoin('category_description as cd',DB::raw('FIND_IN_SET(cd.category_id, u.sub_categories)'), DB::raw(''), DB::raw(''))
//                        ->select('u.id', DB::raw('CONCAT(u.business_name, " ",  "(", cd.name, " , ", city.name, ")") AS name'), DB::raw('GROUP_CONCAT(cd.name)'))
                        ->select('u.id', 'u.business_name',DB::raw('IF(cd.name is null, CONCAT(u.business_name, " ",  "(", "  ", city.name, ")"), CONCAT(u.business_name, " ",  "(", cd.name, " , ", city.name, ")")) AS name'), DB::raw('GROUP_CONCAT(cd.name)'))
//                        ->orWhere('u.city',$cities)
//                            ->Where('u.state',$cities)
                  ->WhereRaw(DB::raw('FIND_IN_SET(u.state, "' . implode($cities, ',') . '")'))
                            ->where('u.added_by',0)
                                ->groupBy('u.id')->get();
            }else{
                return [];
            }
            
            
            
        }
        
        
        if (!Input::has('supplierCities')) {
            
            if(Input::has('subCategoryid')){
                
                
         return  DB::table('users AS u')
                ->leftJoin('cities as city','u.city','=','city.id')
                ->leftJoin('category_description as cd', DB::raw('FIND_IN_SET(cd.category_id, "' . implode($subCategoryids, ',') . '")'), DB::raw('and FIND_IN_SET(cd.category_id, u.sub_categories)'), DB::raw(''), DB::raw(''))
                        ->select('u.id', DB::raw('IF(cd.name is null, CONCAT(u.business_name, " ",  "(", "  ", city.name, ")"), CONCAT(u.business_name, " ",  "(", cd.name, " , ", city.name, ")")) AS name'), DB::raw('GROUP_CONCAT(cd.name)'))
//                        ->orWhere('u.city',$cities)
                ->where(function ($join) use ($subCategoryids) {
                            foreach ($subCategoryids as $subCategoryid) {
                                $join->orWhereRaw(DB::raw("FIND_IN_SET($subCategoryid, u.sub_categories)"));
                            }
                        })
                            ->where('u.added_by',0)
//                                    ->Where('u.city',$cities)
                                ->groupBy('u.id')->get();
//             
            }else{
                
            }
            
            
            
        }
        if (!Input::has('supplierCities') && !Input::has('subCategoryid')) {
            
            
            return [];
            
            
            
        }
//        $subCategoryids = Input::get('subCategoryid');
//        $cities= Input::get('supplierCities');
        
//        return $cities;
        
        
        
        
//        return $value = implode($subCategoryids, ',');
//        printr($subCategoryids);exit;
//        return DB::table('users')
//                ->whereIn('sub_categories', $subCategoryids)
//                ->select()
//                ->get();
//      
//        re
//          
        
        
        
        
        
        
        
        return DB::table('users AS u')
                ->leftJoin('cities as city','u.city','=','city.id')
                ->leftJoin('category_description as cd', DB::raw('FIND_IN_SET(cd.category_id, "' . implode($subCategoryids, ',') . '")'), DB::raw('and FIND_IN_SET(cd.category_id, u.sub_categories)'), DB::raw(''))
                        ->select('u.id', DB::raw('CONCAT(u.business_name, " ",  "(", cd.name, " , ", city.name, ")") AS name'), DB::raw('GROUP_CONCAT(cd.name)'))
//                        ->orWhere('u.city',$cities)
                ->where(function ($join) use ($subCategoryids) {
                            foreach ($subCategoryids as $subCategoryid) {
                                $join->orWhereRaw(DB::raw("FIND_IN_SET($subCategoryid, u.sub_categories)"));
                            }
                        })
//                                ->WhereRaw('u.state',$cities)
                                ->WhereRaw(DB::raw('FIND_IN_SET(u.state, "' . implode($cities, ',') . '")'))
                                ->groupBy('u.id')->get();
//              return DB::table('users AS u')
//                ->select('u.id', DB::raw('CONCAT(u.first_name, " ", u.last_name, "(", ")") AS name'))
//              
//                 ->where(function ($join) use ($subCategoryids){
//                    foreach($subCategoryids as $subCategoryid){
//                        $join->orWhereRaw(DB::raw("FIND_IN_SET($subCategoryid, u.sub_categories)"));
//                    }
//                })
//                        ->orWhere('u.city',$cities)->groupBy('u.ids')->get();
    }

    function NewsLetter() {
        $id = DB::table('newsletter')->where('email', Input::get('email'))->get();
        if (!$id) {
            DB::table('newsletter')->insert(Input::only('email'));
        }
        return 'Successfully Subscribed';
    }
    function RequestApp() {
           $email = Input::get('email');

           $data['email'] = $email;
           
          //return view('emails.mobile_app_request', $data);
           $flag = Mail::send('emails.mobile_app_request', $data, function($message) use ($email) {
                   $message->to("info@firmogram.com")
                           ->subject('Mobile App Request');
                   $message->from(SENDER_EMAIL, SENDER_NAME);
               });
           if ($flag)
               $message = 'Thanks! Your request for mobile app sent successfully.';
           else 
               $message = 'Sorry! There was an error please try again.';
           return $message;   
    }
    function ClaimProfile() {
        $randomToken = str_random(30);
        $password = str_random(10);
        $userid = Input::get('userid');
        $email = Input::get('email');
        
        $user = User::find($userid);
        if ($user->status == 6) {
            $user->token = $randomToken;
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->save();
            $userAEmail = $user->approval_email;
            
            $claim_profileNotification = DB::table('notification')
                                        ->where('notificationName','claim_profile')
                                        ->first();    
            $buyer  = strtr($claim_profileNotification->content, ["@firstName" => $user->first_name , "@lastName" =>$user->last_name ,
                                    "@confirm_email" =>url("auth/confirm/$user->token"), "@loginurl" =>url('auth/login'),
                                        "@email"=>$user->email, '@password'=>$user->password,'@click_here'=>url('unsubscribe') ]);
            
            $data = ['emailbody' => $buyer];
            
            Mail::send('emails.claim_profile', $data, function($message) use ($email , $userAEmail) {
                $message->to($email)
                        ->subject('Successfully Claimed');
                if ($userAEmail != null)
                    $message->cc($userAEmail);
                $message->from(SENDER_EMAIL, SENDER_NAME);
            });
                
            $claim_profile_adminNotification = DB::table('notification')
                                        ->where('notificationName','claim_profile_admin')
                                        ->first();    
            
            $admin_emailN  = strtr($claim_profile_adminNotification->content, ["@userEmail"=>$user->email,]);
            
            $data = ['emailbody' => $admin_emailN];
            
            
            Mail::send('emails.claim_profile_admin', $data, function($message) {
                $message->to(getSettings('notification_email'))
                        ->subject('Claim Profile Request');
                $message->from(SENDER_EMAIL, SENDER_NAME);
            });

            return 'success';
        }
    }
    public function  GetServices () {
        $offset = Input:: get('offset');
        $no_of_records = Input:: get('no_off_records');
        $subcategories = categories::getServices($offset, $no_of_records);
        return $subcategories;
    }

}
