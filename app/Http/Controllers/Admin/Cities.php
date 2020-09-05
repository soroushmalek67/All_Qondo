<?php
namespace App\Http\Controllers\Admin;


use Input;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CitiesRequest;
use App\ModelCities;
use App\ModelStates;

class Cities extends Controller {

    public function Index() {
        $data['cities'] = ModelCities::select("cities.id", "cities.name", "p.name as province","c.name as countryName")->leftJoin('provinces as p', 'p.id', '=', 'cities.state')
                        ->join('country as c',function($join){
                            $join->on('p.country_id','=','c.id');
                        })
                ->get()->toArray();
                        
//                        print_r($data['cities']);exit();
        return view("admin.cities_list", $data);
    }
    
    public function Add() {
        $data['states'] = ModelStates::all()->toArray();
        $data['cityDetails'] = (object) array("id" => null, 'name' => "", 'state' => "", 'featured' => 0, "meta_title" => "", "meta_keywords" => "", 
                                            "meta_description" => "");
        return view("admin.cities_add", $data);
    }
    
    public function Edit($id) {
        $data['states'] = ModelStates::all()->toArray();
        $data['cityDetails'] = ModelCities::find($id);
        return view("admin.cities_add", $data);
    }
    
    public function Save (CitiesRequest $request) {
if (($request->featured) == '') {
           $request->merge(array("featured" => 0));
        }
        $slug = makeSlug($request->get('name'));
        $exestingCities = ModelCities::where('slug', 'LIKE', "%$slug%")->get()->toArray();
        if ($request->get('id') != "") {
            $exestingCities = ModelCities::where('slug', 'LIKE', "%$slug%")->where("id", "!=", $request->get('id'))->get()->toArray();
        }
        $existingSlugs = array_column($exestingCities, 'slug');
        $slug = getUniqueSlug($slug, $existingSlugs);
        $request->merge(array("slug" => $slug));
        
        $newCity = ModelCities::updateOrCreate(['id' => $request->get('id')], $request->except("_token", "id"));
//        $newCity = ModelCities::findOrNew($request->get('id'));
//        $newCity->fill($request->except("_token"));
//        $test = $newCity->save();
        $responseMsg = "Created";
        if ($request->get('id') == "") {
            $responseMsg = "Updated";
        }
        return redirect("/admin-panel/cities/$newCity->id")->with('message', "$responseMsg Successfully"); 
    }
    
    public function Delete () {
        ModelCities::destroy(Input::get('id'));
        return redirect("/admin-panel/cities")->with('message', "Deleted Successfully"); 
    }
        
}