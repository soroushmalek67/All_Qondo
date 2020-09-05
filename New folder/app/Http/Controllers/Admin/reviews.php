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
use DB;

class reviews extends Controller {

    public function Index() {
//        DB::table('users')->where('notification_status', 1)->update(['notification_status' => 0]);
        $data['reviews'] = DB::table('reviews_testimonials as rt')
                            ->leftJoin('users', 'rt.user_id', '=', 'users.id')
                                ->select("users.*", 'rt.*')
                                ->orderBy('rt.id', 'DESC')->paginate(15);
//      
//        $data['pageTitle'] = "All Users";
//        $data['pageNO'] = Input::get('page');
        
        
//         $data['reviews'] = DB::table('reviews_testimonials')->get();
         
//         print_r( $data['reviews']); exit();
        return view("admin.comments", $data);
    }
    public function edit($id ) {
//        DB::table('users')->where('notification_status', 1)->update(['notification_status' => 0]);
        $data['review'] = DB::table('reviews_testimonials as rt')
                            ->leftJoin('users', 'rt.user_id', '=', 'users.id')
                                ->select("users.*", 'rt.*')
                                ->where('rt.id',$id)
                                ->first();
//      
//        $data['pageTitle'] = "All Users";
//        $data['pageNO'] = Input::get('page');
        
        
//         $data['reviews'] = DB::table('reviews_testimonials')->get();
         
//         print_r( $data['review']); exit();
        return view("admin.commentsEdit", $data);
    }
    public function delete($id ) {

        $data['review'] = DB::table('reviews_testimonials')
                           ->where('id',$id)
                           ->delete();

        return redirect('admin-panel/comments');
    }
    
    public function aprove($id ) {
        $data['review'] = DB::table('reviews_testimonials as rt')
                ->where('rt.id',$id)           
                ->update(['aprove'=>1]);

        return redirect('admin-panel/comments');
    }
    
    
        
}
