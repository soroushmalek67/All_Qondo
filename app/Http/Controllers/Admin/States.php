<?php
namespace App\Http\Controllers\Admin;


use Input;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatesRequest;
use App\ModelStates;
use DB;
class States extends Controller {

    public function Index() {
        $data['states'] = ModelStates::leftJoin('country as c' ,'c.id','=','provinces.country_id')
                ->select('provinces.*','c.name as countryName','c.id as countryID')
                ->get()
                ->toArray();
//        print_r($data['states']); exit;
        
        
        $data['country'] = DB::table('country')->get();
        
        
        
        return view("admin.states_list", $data);
    }
    
    public function Add($id = '') {
        $data['states'] = ModelStates::all()->toArray();
        if ($id == '') {
            
            $data['country'] = DB::table('country')->get();
//            print_r($data['country']); exit;
            $data['stateDetails'] = (object) array("id" => null, 'name' => "", 'tax_percent' => "",'country_id'=>"");
        } else {
            $data['country'] = DB::table('country')->get();
            $data['stateDetails'] = ModelStates::find($id);
        }
        return view("admin.states_add", $data);
    }
    
    public function Save (StatesRequest $request) {
        $newState = ModelStates::updateOrCreate($request->only('id'), $request->except("_token", "id"));
        
        $responseMsg = "Updated";
        if ($request->get('id') == "") {
            $responseMsg = "Created";
        }
        return redirect("/admin-panel/states")->with('message', "$responseMsg Successfully"); 
    }
    
    public function Delete () {
        ModelStates::destroy(Input::get('id'));
        return redirect("/admin-panel/states")->with('message', "Deleted Successfully"); 
    }
        
}