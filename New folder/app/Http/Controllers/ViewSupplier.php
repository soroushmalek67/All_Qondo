<?php
namespace App\Http\Controllers;
use DB;
use Mail;
use App\User;
use App\reviewModel;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\reviewRequest;
//use Illuminate\Support\Facades\Request;
class ViewSupplier extends Controller {
    
    public function Index($slug, $id,Request $request) {
//        var_dump(Auth::id());
//        exit();
       {
            
            
        $data['supplierDetails'] = DB::table('users as u')
                                        ->leftJoin(DB::raw('(SELECT count(id) quotesAccepted, supplier_id FROM quotes WHERE status = 1 '
                                                        .'GROUP BY supplier_id) as q')
                                                , 'q.supplier_id', '=', 'u.id')
                                        ->leftJoin('category as ct', DB::raw('FIND_IN_SET(ct.id, u.sub_categories)'), 
                                                DB::raw(''), DB::raw(''))
                                        ->leftJoin('cities as c' , 'c.id', '=', 'u.city')
                                        ->leftJoin('provinces as s' , 's.id', '=', 'u.state')
                                       
                                        ->leftJoin('transactions as tr' , 'tr.userid', '=', 'u.id')
                                        ->leftJoin('reviews_testimonials as review' , 'review.user_id', '=', 'u.id')
                                        ->rightJoin('category_description as cd', DB::raw('FIND_IN_SET(cd.category_id, u.main_categories)'), 
                                                DB::raw(''), DB::raw(''))
                                        ->select("u.id", "u.business_name", 'c.name as city', 's.name as state', 'u.company_logo', 'u.updated_at', 'u.service_states',
                                                'q.quotesAccepted', 'u.street_address', 'u.website', 'u.postal_code', 'u.country', 'u.created_at', 'u.service_cities',
                                                'u.describe_product','u.certificate_awards','u.award as awards','u.video as youtube','u.facebook as facebook','u.twitter as twitter','u.googleplus as googleplus','u.phone_number as userPhoneNumber','u.membership as Usermembership','u.main_categories as parent_categories','u.sub_categories as child_categories','u.linkedin as linked',
                                                'u.company_banner as banner','u.company_logo as logo',
                                               'tr.package as package','tr.expires_at as pakage_expires_at',
                                                'review.review as review','review.stars as reviewStars',
                                               
                                                DB::raw("GROUP_CONCAT(DISTINCT cd.name) as mainCategories"), 
                                        		'u.membership', 'u.bids', 'u.status', 'ct.slug')
                                        ->where("u.id", $id)->where(function ($join) {
                                            $join->orWhere('u.user_type', 2);
                                            $join->orWhere('u.user_type', 3);
                                        })
                                        ->groupBy('u.id')->first();
                                        
                                        $servedarea=explode(",",$data['supplierDetails']->service_states);
                                         $cities=explode(",",$data['supplierDetails']->service_cities);
                                         
//                                         $servecity=$data['supplierDetails']->service_cities;
                                         
                                         
//                                                                                  print_r($servedarea); exit();
                                        if(!empty($servedarea) && !empty($data['supplierDetails']->service_cities)){
                                            $data['servedAreas']=DB::table('provinces as p')
                                                ->leftjoin('cities as c', DB::raw('c.id IN ('.$data['supplierDetails']->service_cities.') and c.state = p.id'), DB::raw(''), DB::raw('') )
                                                ->select('c.name','p.iso' , 'c.id')
                                                ->whereIn('p.id' , $servedarea)
                                                ->get();
                                        }
                                          
                                          
                                          
//                                                    print_r($data['servedAreas']);exit;
                                                                                  

                                         
                                         $main_cate=explode(",", $data['supplierDetails']->parent_categories);
                                          $child_cate=explode(",", $data['supplierDetails']->child_categories);
                                         $data['maincategories']= DB::table('users as u');
                                        $awards=explode(",", $data['supplierDetails']->awards);
                                        
//                                            print_r( $child_cate);
//                                            exit();
                                             $data['cat_child']=DB::table('category as ct')
                                                     ->leftjoin('category_description','category_description.category_id','=','ct.id')
                                                  ->whereIn('ct.id',$child_cate)
                                                  ->get();
//                                             print_r($data['cat_child']);
//                                             exit();
                                              $data['cat_main']=DB::table('category_description as cd')
                                                  ->whereIn('cd.category_id',$main_cate)
                                                  ->get();
                                           
//                                             $data['cat1']= array_merge($data['cat1'],$data['cat']);
//                                            $data['cat1']=$data['cat1']+$data['cat'];
                                            
                                     
                                        
                                        $data['awards']=DB::table('awards')
                                                            ->whereIn('id',$awards)
                                                            ->get();
                                        
                                       $data['products']=DB::table('products_services')
                                                            ->where('users_id',$id)
                                                            ->get();
                                       $data['coupons']=DB::table('promotion_coupons')
                                                            ->where('user_id',$id)
                                                            ->get();
                                       $data['reviews']=DB::table('reviews_testimonials')
                                                            ->where('user_id',$id)
                                                            ->where('aprove',1)
                                                            ->get();
                                        
                                       
                                       $data['videoLink']= str_replace("watch?v=","embed/",$data['supplierDetails']->youtube);
                                       
                                       $data['user_pakage']=DB::table('transactions')
                                                            ->where('userid',Auth::id())
                                                            ->get();
                                       
                                       
                                       
                                       
//                                       $data['unregisterd']=0;
//                                   
//                                   
//                                       echo'child';
//        echo'<br>';     
//         print_r($data['supplierDetails']); exit();
//         print_r( $data['user_pakage']);
//                                        print_r($data['cat_main']);
//        echo '<br>'; 
//        echo'child';
//        echo'<br>';
//                                       print_r($data['cat_child']);
//                                        exit();
                                        
        $data['metas'] = get_page_meta_array((isset($data['supplierDetails']->business_name))?$data['supplierDetails']->business_name:'Supplier');
        $data['supplier_id']=$id;
        $data['supplier_slug']=$slug;
        $data['unregisterd']=$request->session()->get('unregisterd');
            return view("view_supplier", $data);
        
        
        
            
        }

       
    }
    
    public function Suppliers () {
        $metas = get_page_meta_array('Suppliers');
        $supplierPage = true;
        return view("suppliers", compact('supplierPage', 'metas'));
    }
    
    public function viewSuppliers () {
        return view("supplier");
    }
    
     public function reviewsave (reviewRequest $request ) {
         
//          $request =new reviewRequest(); 
        
//         print_r($request->all()); exit;
//         exit();
         
        $review =new reviewModel();
       
        $review->user_id= Auth::id();
        
        if($request->input('stars')==null){
            $review->stars=0;
        }else{
        $review->stars=$request->input('stars');
        }
        $review->review=$request->input('reviews');
        $review->user_id=$request->input('supplierId');
        $review->aprove=0;
        
        if(is_numeric ($request->input('slug'))){
            $review->request_id=$request->input('slug');
        }
              $review->save();  
              
              
//               $admin_email='info@firmogram.com';
               $admin_email='info@firmogram.com';
            
            $userDetails = User::find($request->input('supplierId'));
            
               
            $reviewNotification = DB::table('notification')
                                        ->where('notificationName','review')
                                        ->first();    
            $buyer  = strtr($reviewNotification->content, ["@biznusName" => $userDetails->business_name , "@urlreview" =>url('admin-panel/comments') ,
                                  '@click_here'=>url('unsubscribe')  ]);
//            print_r($buyer);exit();
            
            $data = ['emailbody' => $buyer];
            
               
            
                        Mail::send('emails.reviewIn', $data, function($message) use ($admin_email){
                            $message->to($admin_email)
                                ->subject('Comments on company');
                            $message->from(SENDER_EMAIL, SENDER_NAME);
                        });
              
              
        
//              supplier-profile/door-filter-technologies/288
              $address='supplier-profile/'.$request->input('slug').'/'.$request->input('supplierId');
              
              if(is_numeric($request->input('slug'))){
                  return redirect('dashboard');
              }else{
                return redirect($address);
              }
              
              
              
    }
}