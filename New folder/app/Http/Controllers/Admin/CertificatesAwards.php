<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\awardRequest;
use App\Http\Controllers\Controller;
use App\awardModel;
use File;
use Input;
use DB;
use Auth;

class CertificatesAwards extends Controller {

    public function Index() {
       $data['awards']=DB::table('awards') ->orderBy('id', 'DESC')->paginate(15);
       
        return view("admin.awards",$data);
    }
     public function formaward() {
//       $data['awards']=DB::table('awards')->get();
       
        return view("admin.awardsAdd");
    }
     public function save(awardRequest $request) {
       $val=session()->get('admin_user')->id;
         $award =new awardModel();
         if($request->get('save')!='update'){
              $award->name=$request->awards;
              
              
              
//              print_r($val); exit();
              
             if ($request->file('awardImage') != null) {
                $fileName = saveOrReplaceFile("img/awards", $request->file('awardImage'), "", $val, $award->created_at);

                $award->image = $fileName;

                if (!empty( $award->image) &&
                        File::exists(public_path("img/awards/" . getFolderStructureByDate( $award->created_at) . "/"
                                        . $award->image))) {
                    File::delete("img/product/" . getFolderStructureByDate( $award->created_at) . "/" .  $award->image);
                }
            }
         
            $award->save();
         }else{
             
             if ($request->file('awardImage') != null) {
                $fileName = saveOrReplaceFile("img/awards", $request->file('awardImage'), "", $val, $request->get('created'));

                $award->image = $fileName;

                if (!empty( $award->image) &&
                        File::exists(public_path("img/awards/" . getFolderStructureByDate( $request->get('created')) . "/"
                                        . $award->image))) {
                    File::delete("img/product/" . getFolderStructureByDate( $request->get('created')) . "/" .  $award->image);
                }
                
                DB::table('awards') ->where('id',$request->input('id'))
                        ->update(['image'=>$fileName,])
                    ;
            }
             
             
                DB::table('awards')->where('id',$request->input('id'))
                        
                        ->update(['name'=>$request->input('awards'),'created_at'=>$request->input('created'),])
                     ;
             
         }
        
         
         
            
        return redirect("admin-panel/awards");
    }
     public function edit($id) {
         
//         print_r('hi');
//         exit();
          
       
         $data['awards']=DB::table('awards')->find($id);
       
        return view("admin.awardedit",$data);
    }
     public function delete($id) {
         
//         print_r('hi');
//         exit();
          
       
        DB::table('awards')->where('id',$id)
                 ->delete();
       
        return redirect("admin-panel/awards");
    }
    
   
}
