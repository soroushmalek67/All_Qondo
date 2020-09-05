<?php

namespace App\Http\Controllers\Admin;

use Input;
use App\Http\Controllers\Controller;
use App\Models\BuildingModel;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StatesRequest;
use App\Http\Requests\Admin\BuildingsRequest;
use App\ModelCountry;
use App\ModelStates;
use App\ModelCities;
use DB;
use App\User;
use Mail;

class Buildings extends Controller {

    public function Index() {


        $data['buildings'] = BuildingModel::select("buildings.*", "cities.name as CityName", "p.name as province", "c.name as countryName")
                        ->leftJoin('cities', 'cities.id', '=', 'buildings.city_id')
                        ->join("provinces as p", "p.id", "=", "buildings.state_id")
                        ->join("country as c", "c.id", "=", "buildings.country_id")
                        ->orderBy('status', 'asc')
                        ->get()->toArray();

        return view("admin.buildings_list", $data);
    }

//       public function Add() {
//        $data['states'] = ModelStates::all()->toArray();
//        $data['buildingDetails'] = (object) array("id" => null, 'building_name' => "", 'country_id' => "", 'state_id' => "", 'city_id' => "", 'Address' => "" );
//        return view("admin.buildings_add", $data);
//    }
//    
    public function UnApproveList() {

        $data['buildings'] = BuildingModel::select("buildings.*", "cities.name as CityName", "p.name as province", "c.name as countryName")
                        ->leftJoin('cities', 'cities.id', '=', 'buildings.city_id')
                        ->join("provinces as p", "p.id", "=", "buildings.state_id")
                        ->join("country as c", "c.id", "=", "buildings.country_id")
                        ->where('buildings.status', '0')
                        ->get()->toArray();


        return view("admin.buildings_list", $data);
    }

    public function Edit($id = null) {

        $data['cities'] = ModelCities::all()->toArray();
        $data['states'] = ModelStates::all()->toArray();


        if (is_null($id)) {
            $data['buildingDetails'] = (object) ["id" => null, 'building_name' => "", 'country_id' => "", 'state_id' => "", 'city_id' => "", 'lot_number' => "",
                        'postal_code' => "", 'url' => "", 'management_company' => "", 'Phone' => "", 'onsite_manager' => "", 'Address' => "", 'status' => 1];
        } else {
            $data['buildingDetails'] = BuildingModel::find($id);
        }



        return view("admin.buildings_add", $data);
    }

    public function Save(BuildingsRequest $request) {

        if ($request->id !== '') {
            if ($request->previous_status == 0 && $request->status == 1) {
                $users = User::select("users.*")
                        ->where('users.status', 7)
                        ->where('users.building_id', $request->id)
                        ->get();

                if (count($users) > 0) {
                    foreach ($users as $user) {
                        $user_info = User:: where('id', $user->id)
                                ->update(['status' => 6]);

                        if ($user_info) {

                            $registerNotification = DB::table('notification')
                                    ->where('notificationName', 'register')
                                    ->first();
                            $buyer = strtr($registerNotification->content, ["@username" => $user->first_name . " " . $user->last_name,
                                "@useremail" => $user->email, "@urlconfirmemail" => url("auth/confirm/$user->token"),
                                "@siteurl" => url("auth/login")
                            ]);
                            $result = ['emailbody' => $buyer];

                            $flag = Mail::send('emails.user_confirm', $result, function($message) use ($user) {
                                        $message->to($user->email)
                                                ->subject('Successfully Registered');
                                        $message->from(SENDER_EMAIL, SENDER_NAME);
                                    });
                        }
                    }
                }
            }
        }

    
        $request->merge(array('country_id' => 1));
//          return $request->all();
        if ($request->get('id') == '') {
            BuildingModel:: create($request->except("_token", "id"));
        } else {

            $newState = BuildingModel::updateOrCreate(['id' => $request->get('id')], $request->except("_token", "id"));
        }
        $responseMsg = "Updated";
        if ($request->get('id') == "") {
            $responseMsg = "Created";
        }
        
		return redirect("/admin-panel/buildings")->with('message', "$responseMsg Successfully");
    }

    public function Delete() {
        BuildingModel::destroy(Input::get('id'));
        return redirect("/admin-panel/buildings")->with('message', "Deleted Successfully");
    }
	
	//Muaawiya's
	public function ApproveSelectedBuildings(Request $request) {
		DB::enableQueryLog();  
        if(!$request->has('approved_buildings') || $request->approved_buildings == '')
		{
			 return redirect("/admin-panel/buildings/unapproved")->with('message', "Please select building(s) first");
		}
		
		if ($request->approved_buildings !== '') {
			
                $buildings = explode(',', $request->approved_buildings);
				
                if (count($buildings) > 0) {
                    foreach ($buildings as $building) {
						
						DB::table('buildings')
						->where('id', $building)
						->update(['status' => 1]);

						$users = User::select("users.*")
                        ->where('users.status', 7)
                        ->where('users.building_id', $building)
                        ->get();
						
						if (count($users) > 0) {
							foreach ($users as $user) {
								$user_info = User:: where('id', $user->id)
										->update(['status' => 6]);
		
								if ($user_info) {
		
									$registerNotification = DB::table('notification')
											->where('notificationName', 'register')
											->first();
									$buyer = strtr($registerNotification->content, ["@username" => $user->first_name . " " . $user->last_name,
										"@useremail" => $user->email, "@urlconfirmemail" => url("auth/confirm/$user->token"),
										"@siteurl" => url("auth/login")
									]);
									$result = ['emailbody' => $buyer];
		
									$flag = Mail::send('emails.user_confirm', $result, function($message) use ($user) {
												$message->to($user->email)
														->subject('Successfully Registered');
												$message->from(SENDER_EMAIL, SENDER_NAME);
											});
								}
							}
						}
					}
				}
        }
		
        return redirect("/admin-panel/buildings/unapproved")->with('message', "Builidngs Approved Successfully");
    }

}
