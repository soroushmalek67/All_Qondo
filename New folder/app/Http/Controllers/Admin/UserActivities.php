<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Input;
use App\Models\UserPagesVisits;
use App\Models\UserActivityModel;

class UserActivities extends Controller {

    public function Index() {
        $userActivitiesQuery = UserActivityModel::orderBy('id', 'DESC');
        
        if (!empty(Input::get('startDate')) || !empty(Input::get('endDate'))) {
            $userActivitiesQuery->whereBetween('created_at', [Input::get('startDate'), Input::get('endDate')]);
        }
        
        $data['users'] =$userActivitiesQuery->paginate(100);
        $data['pageTitle'] = "Users Activities";
        return view("admin.users_activity", $data);
    }
    
    public function Visits() {
        $userActivitiesQuery = UserPagesVisits::orderBy('id', 'DESC');
        
        if (!empty(Input::get('startDate')) || !empty(Input::get('endDate'))) {
            $userActivitiesQuery->whereBetween('created_at', [Input::get('startDate'), Input::get('endDate')]);
        }
        
        $data['visits'] =$userActivitiesQuery->paginate(100);
        $data['pageTitle'] = "Users Page Visits";
        
        return view("admin.users_visits", $data);
    }
        
}
