<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Input;
//use Config;
use PDO;
use App\User;
use Session;

class Settings extends Controller {

    public function Index() {
//        Config::set('database.fetch', PDO::FETCH_ASSOC);
        DB::setFetchMode(PDO::FETCH_ASSOC);
        $allSettingsObj = DB::table('settings')->get();
        DB::setFetchMode(PDO::FETCH_CLASS);
        
        $allSettings = array_column($allSettingsObj, 'value', 'key');
        
        $adminDetails = User::find(Session::get('admin_user')->id);
        
        return view("admin.settings", compact('allSettings', 'adminDetails'));
    }
    
    
    public function Save() {
        $userArray = Input::only('first_name', 'last_name', 'email');
        if (!empty(Input::get('password'))) {
            $userArray = Input::only('first_name', 'last_name', 'email', 'password');
        }
        
        $adminUser = User::find(Session::get('admin_user')->id);
        $adminUser->fill($userArray);
        $adminUser->save();
        Session::put('admin_user', (object) $adminUser->toArray());
        
        $query = "UPDATE settings SET `value` = CASE `key` ";
        $updateParameters = Input::except('_token', 'first_name', 'last_name', 'email', 'password');
        
        
//        print_r($updateParameters);exit;
       
        if(isset($updateParameters['cat_rel_data'])){
            $updateParameters['cat_rel_data']=1;
        }else{
            $updateParameters['cat_rel_data']=0;
        }
        
        if(isset($updateParameters['try_it_free_icon'])){
            $updateParameters['try_it_free_icon']=1;
        }else{
            $updateParameters['try_it_free_icon']=0;
        }
        
        if(isset($updateParameters['auto_pilot'])){
            $updateParameters['auto_pilot']=1;
        }else{
            $updateParameters['auto_pilot']=0;
        }
        
//         print_r($updateParameters['cat_rel_data']);exit();
        
        $allKeys = [];
        
        foreach ($updateParameters as $key => $value) {
            $query .= " WHEN '$key' THEN '$value' ";
            
            $allKeys[] = "'$key'";
        }
        $query .= "END WHERE `key` IN (".  implode(",", $allKeys).")";
        DB::statement($query);
        return redirect("admin-panel/settings/general")->with('message', 'Updated Successfully');
    }
//    changes by salman
    public function Memberships() {
//        Config::set('database.fetch', PDO::FETCH_ASSOC);
        DB::setFetchMode(PDO::FETCH_ASSOC);
        $allSettingsObj = DB::table('settings')->get();
        DB::setFetchMode(PDO::FETCH_CLASS);
        
        $allSettings = array_column($allSettingsObj, 'value', 'key');
        
        $adminDetails = User::find(Session::get('admin_user')->id);
        
        return view("admin.memberships", compact('allSettings', 'adminDetails'));
    }
    
    public function SaveMemberships() {
        $query = "UPDATE settings SET `value` = CASE `key` ";
        $updateParameters = Input::except('_token', 'first_name', 'last_name', 'email', 'password');
        $allKeys = [];
        
        foreach ($updateParameters as $key => $value) {
            $query .= " WHEN '$key' THEN '$value' ";
            $allKeys[] = "'$key'";
        }
        $query .= "END WHERE `key` IN (".  implode(",", $allKeys).")";
        DB::statement($query);
//        echo "$query";
        return redirect("admin-panel/settings/memberships")->with('message', 'Updated Successfully');
    }
//    changes by salman
    
}
