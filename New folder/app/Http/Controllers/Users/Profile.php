<?php namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use File;
use App\Categories;
use App\User;
use App\productModel;
use App\couponModel;
use App\ModelStates;
use App\Http\Requests\Users\ProfileRequest;
use App\Http\Requests\Users\productRequest;
use App\Http\Requests\Users\couponRequest;
use App\Models\BuildingModel;

class Profile extends Controller {
    
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
            $this->viewData['userPostResponser'] = "Buyer";
        }
    }
    
    public function index() {

        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Profile');

        $data['categories'] = Categories::getMainCategories();
        $data['linkedinIndustries'] = DB::table('linkedin_industries')->orderBy('name', "ASC")->get();
        $data['awards'] = DB::table('awards')->orderBy('name', "ASC")->get();
        
//        $data['userDetails'] = User::find($this->userid);
        $data['userDetails'] = DB::table('users')
                                 ->leftJoin('transactions as tr' , 'tr.userid', '=', 'users.id')
                                 ->leftJoin('buildings as b' , 'b.id', '=', 'users.building_id')
                
                                 ->select('users.*','users.created_at as creat','tr.*', 'b.building_name', 'b.Address')
                ->where('users.id', $this->userid)    
                 ->first();
//        print_r($data['userDetails']);exit;
        
         if($data['userDetails']->added_by!=0){
            
            return redirect('complete-profile');
        }
     
        
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
     
      
//        $data['cities'] = ModelCities::where('state', $data['userDetails']['state'])->orderBy('name', 'ASC')->get();
//        printr( $data['userDetails']);exit;
        $data['buildings'] = BuildingModel:: leftjoin('cities as c','c.id', '=', 'buildings.city_id')
                ->leftjoin('provinces as p', 'p.id', '=', 'buildings.state_id')
                ->leftjoin('country', 'country.id', '=', 'buildings.country_id')
                ->select('buildings.*', 'p.name as province', 'c.name as city', 'country.name as country')
                ->get();
//         ->leftjoin('provinces as p', 'p.id', '=', 'u.state')
      
        
        return view('users.profile', $data);
    }
    
    public function save (ProfileRequest $request) {
        
    	
//        print_r($request->all());
//        exit();
        if (Auth::user()->status == 2) {
    		$request->merge(array('status' => 1));
    	}
    	
        if ($request->has('industries_you_buy')) {
            $request->merge(array('industries_you_buy' => implode(",", $request->get('industries_you_buy'))));
        }
        if ($request->has('industries_you_sell')) {
            $request->merge(array('industries_you_sell' => implode(",", $request->get('industries_you_sell'))));
        }
        
        if ($request->has('award')) {
          
            $request->merge(array('award' => implode(",", $request->get('award'))));
        }
        
        if(!$request->has('award')){
           
            $request->merge(array('award' => " "));
        }
        if (!empty($request->get('main_categories'))) {
            $request->merge(array('main_categories' => implode(",", $request->get('main_categories'))));
            $request->merge(array('sub_categories' => implode(",", $request->get('sub_categories'))));
        }
        
        if (!empty($request->get('service_states'))) {
            $request->merge(array('service_states' => implode(",", $request->get('service_states'))));
            $request->merge(array('service_cities' => implode(",", $request->get('service_cities'))));
        }
        
        if (!$request->has('anonymous')) {
            $request->merge(array('anonymous' => 0));
        }
        
//        print_r($request->get('facebook'));
//        exit();
        
        $request->merge(['company_slug' => ($request->get('business_name'))]);
        $request->merge(['facebook' => ($request->get('facebook'))]);
        $request->merge(['twitter' => ($request->get('twitter'))]);
        $request->merge(['googleplus' => ($request->get('gplus'))]);
        $request->merge(['video' => ($request->get('youtube'))]);
        $request->merge(['linkedin' => ($request->get('linkedin'))]);
        
        $userDetails = User::find($this->userid);
 
        $userDetailsArray = $userDetails->toArray();
		
		
        if (Auth::user()->status == 1 && $userDetailsArray['user_type'] != 2) {
    		$building_id = $request->get('building_id');
                $building_info  = BuildingModel:: select('buildings.*', 'country.name as country')->join('country', 'country.id', '=', 'buildings.country_id')->where('buildings.id', '=', $building_id)->first();
                $request->merge(['city' => $building_info->city_id, 'state' => $building_info->state_id, 'postal_code' => $building_info->postal_code, 'street_address' => $building_info->Address, 'country' => $building_info->country]);
    	}
        
        
//        print_r($userDetailsArray);        exit();
        if ($request->file('company_logo_file') != null) {
            $fileName = saveOrReplaceFile("img/compay_logos", $request->file('company_logo_file'), "", $this->userid, $userDetailsArray['created_at']);
//             print_r($fileName);
            $request->merge(array('company_logo' => $fileName));
        
            if (!empty($userDetailsArray['company_logo']) && 
                    File::exists(public_path("img/compay_logos/".getFolderStructureByDate($userDetailsArray['created_at'])."/"
                            .$userDetailsArray['company_logo']))) {
                File::delete("img/compay_logos/".getFolderStructureByDate($userDetailsArray['created_at'])."/".$userDetailsArray['company_logo']);
            }
        }
        
        //profile_banner
        
        if ($request->file('company_banner_file') != null) {
            $fileName1 = saveOrReplaceFile("img/profile_banner", $request->file('company_banner_file'), "", $this->userid, $userDetailsArray['created_at']);
           
            $request->merge(array('company_banner' => $fileName1));

        
            if (!empty($userDetailsArray['company_banner']) && 
                    File::exists(public_path("img/profile_banner/".getFolderStructureByDate($userDetailsArray['created_at'])."/"
                            .$userDetailsArray['company_banner']))) {
                File::delete("img/profile_banner/".getFolderStructureByDate($userDetailsArray['created_at'])."/".$userDetailsArray['company_banner']);
            }
        }
        
        
       
        
        //profile_banner
        
        if ($request->get('password') == "") {
            $userDetails->fill($request->except('_token', 'email', 'company_logo_file', 'password_confirmation', 'password'));
        } else {
            $request->merge(array('password' => bcrypt($request->get('password'))));
            $userDetails->fill($request->except('_token', 'email', 'company_logo_file', 'password_confirmation'));
        }
        
        if ($userDetailsArray['status'] == 6) {
        	$userDetails->created_at = \Carbon\Carbon::now()->toDateTimeString();
        	$userDetails->status = 1;
        }
        
        $userDetails->added_by=0;
//          $userDetails->facebook= $request->merge(['facebook' => makeSlug($request->get('facebook'))]);
//        print_r(re);
//        exit();
        $userDetails->save();
        
        return redirect("profile")->with('message', 'Updated Successfully');
    }
    public function service_product(){
        
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Profile');
        $data['userDetails'] = User::find($this->userid);
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        $data['products'] = DB::table('products_services')
                            ->where('users_id',$this->userid)->paginate(10);
        
//        $data['cities'] = ModelCities::where('state', $data['userDetails']['state'])->orderBy('name', 'ASC')->get();
//        printr( $data['userDetails']->service_kilometers);exit;
        
      
//        exit();
        return view('users.products', $data);
        
    }
    public function service_product_form(){
        
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Profile');
        $data['userDetails'] = User::find($this->userid);
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        $data['products'] = productModel::find(0);
        $data['flage']=0;
        
//        $data['cities'] = ModelCities::where('state', $data['userDetails']['state'])->orderBy('name', 'ASC')->get();
//        printr( $data['userDetails']->service_kilometers);exit;
        
      
//        exit();
        return view('users.addproduct', $data);
        
    }
    public function service_product_edit($id){
        
        
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Profile');
        $data['userDetails'] = User::find($this->userid);
//        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        $data['products'] = productModel::find($id);
        $data['flage']='1';
        
//        print_r($data['products']);
//        exit();
//        $data['cities'] = ModelCities::where('state', $data['userDetails']['state'])->orderBy('name', 'ASC')->get();
//        printr( $data['userDetails']->service_kilometers);exit;
        
      
//        exit();
        return view('users.service-product', $data);
        
    }
    
    public function service_product_delete($id ){
        
         $request=new productModel;
        DB::table($request->getTable())
            ->where('id', $id)
            ->delete();
            
        return redirect("products")->with('message', 'product Successfully delete' );
        
    }
    
    public function service_product_save(productRequest $request ){
        
        $msg="";
          $product= new productModel;
          
//           print_r();
//           exit();
        
          if ($request->get('product-add') != 'update') {


            $product->users_id = Auth::user()->id;
            $product->name = $request->input('product_title');
            $product->description = $request->input('describe_product');
            if ($request->file('product_image_file') != null) {
                $fileNamep = saveOrReplaceFile("img/product", $request->file('product_image_file'), "", $this->userid, $product->created_at);

                $product->image = $fileNamep;

                if (!empty($product->image) &&
                        File::exists(public_path("img/product/" . getFolderStructureByDate($product->created_at) . "/"
                                        . $product->image))) {
                    File::delete("img/product/" . getFolderStructureByDate($product->created_at) . "/" . $product->image);
                }
            }


            $product->save();
            $msg='product add Successfully';
        } else {
            
             $request->merge(array());
             $fileNamep="";
             if ($request->file('product_image_file') != null) {
                $fileNamep = saveOrReplaceFile("img/product", $request->file('product_image_file'), "", $this->userid, $request->input('date'));

                $product->image = $fileNamep;

                if (!empty($product->image) &&
                        File::exists(public_path("img/product/" . getFolderStructureByDate($request->input('date')) . "/"
                                        . $product->image))) {
                    File::delete("img/product/" . getFolderStructureByDate($product->created_at) . "/" . $product->image);
                }
                
                DB::table($product->getTable())
            ->where('id', $request->input('product_id'))
            ->update(['image'=>$fileNamep]);
            }

             
            DB::table($product->getTable())
            ->where('id', $request->input('product_id'))
            ->update(['name' => $request->input('product_title'),
                'description'=>$request->input('describe_product'),
                'created_at'=>$request->input('date'),
                ]);
            
            $msg='product update Successfully';
            
        }


        return redirect("products")->with('message',$msg);
        
    }
    
    
    public function coupon_form(){
        
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Profile');
        $data['userDetails'] = User::find($this->userid);
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
//        $data['cities'] = ModelCities::where('state', $data['userDetails']['state'])->orderBy('name', 'ASC')->get();
//        printr( $data['userDetails']->service_kilometers);exit;
        
      
//        exit();
        return view('users.addcoupon', $data);
        
    }
    public function coupon_edit($id){
        
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Profile');
        $data['userDetails'] = User::find($this->userid);
        $data['coupon'] = couponModel::find($id);
//        $data['cities'] = ModelCities::where('state', $data['userDetails']['state'])->orderBy('name', 'ASC')->get();
//        printr( $data['userDetails']->service_kilometers);exit;
        
      
//        exit();
        return view('users.product_coupon', $data);
        
    }
    
    
    //copon list
    
    public function coupon(){
        
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Profile');
        $data['userDetails'] = User::find($this->userid);
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        $data['coupons'] = DB::table('promotion_coupons')
                            ->where('user_id',$this->userid)->paginate(10);;
//        $data['cities'] = ModelCities::where('state', $data['userDetails']['state'])->orderBy('name', 'ASC')->get();
//        printr( $data['userDetails']->service_kilometers);exit;
        
      
//        exit();
        return view('users.coupons', $data);
        
    }
    //end list
    
    
      public function coupon_delete( $id ){
               $coupon = new couponModel(); 
                  
                   DB::table($coupon->getTable())
            ->where('id', $id)
            ->delete();
                   
                   return redirect("coupons")->with('message', 'Coupon Successfully delete');
      }
    
    
    public function coupon_save(couponRequest $request ){
        
        $msg="";
        $coupon= new couponModel;
          
//           print_r($request->all());
//           exit();
        
        if($request->get('coupon-add')!='update'){
            $coupon->user_id=Auth::user()->id;
          
          $coupon->title=$request->input('coupon_title');
          $coupon->stars=$request->input('coupon_star');
          $coupon->discount=$request->input('coupon_discount');
          $coupon->description=$request->input('describe_coupon');
           if ($request->file('coupon_image_file') != null) {
            $fileNamec = saveOrReplaceFile("img/coupon", $request->file('coupon_image_file'), "", $this->userid, $coupon->created_at);
           
         
        
            if (!empty($coupon->image) && 
                    File::exists(public_path("img/coupon/".getFolderStructureByDate($coupon->created_at)."/"
                            .$coupon->image))) {
                File::delete("img/coupon/".getFolderStructureByDate($coupon->created_at)."/".$coupon->image);
            }
            
              $coupon->image=$fileNamec;
        }
          
           
        
        
        $coupon->save();
        $msg='Coupon add Successfully';
    }else{
            
//            print_r($coupon->created_at);
//        exit();
//            $fileNamec="";
            if ($request->file('coupon_image_file') != null) {
            $fileNamec = saveOrReplaceFile("img/coupon", $request->file('coupon_image_file'), "", $this->userid, $request->input('date'));
            
            if (!empty($coupon->image) && 
                    File::exists(public_path("img/coupon/".getFolderStructureByDate($request->input('date'))."/"
                            .$coupon->image))) {
                
               
                File::delete("img/coupon/".getFolderStructureByDate($request->input('date'))."/".$coupon->image);
            }
            $coupon->image=$fileNamec;
              DB::table($coupon->getTable())
            ->where('id', $request->input('coupon_id'))
            ->update(['image'=>$fileNamec]);
           
        }
            
            
            DB::table($coupon->getTable())
            ->where('id', $request->input('coupon_id'))
            ->update(['title' => $request->input('coupon_title'),
                'description'=>$request->input('describe_coupon'),
                'stars'=>$request->input('coupon_star'),
                'discount'=>$request->input('coupon_discount'),
                  'created_at'=>$request->input('date'),
                ]);
            
            
             $msg='Coupon updated Successfully';
            
        }
        
          
        
      return redirect("coupons")->with('message', $msg);
        
    }
    
    
    public function CompleteProfile() {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('Complete Profile');

        $data['categories'] = Categories::getMainCategories();
        $data['linkedinIndustries'] = DB::table('linkedin_industries')->orderBy('name', "ASC")->get();
        $data['userDetails'] = User::find($this->userid);
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        
        $data['userDetails'] = Auth::user();
//        $data['cities'] = ModelCities::where('state', $data['userDetails']['state'])->orderBy('name', 'ASC')->get();
//        printr( $data['userDetails']->service_kilometers);exit;
        return view('users.complete_profile', $data);
    }
    
    
    
}
