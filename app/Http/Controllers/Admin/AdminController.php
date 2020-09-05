<?php
namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;
use Session;
use Request;


class AdminController extends Controller {

    public function Index () {
        return view("admin.index");
    }
    
    public function NewsLetterEmails () {
        $data['subscribers'] = DB::table('newsletter')->paginate(25);
        return view("admin.newsletter", $data);
    }
	
	public static function LogAdminActivity($module_name, $action) {
		
		//$user =  new App\User();
		//$session = new Session();
		//$resquest = \Illuminate\Http\Request;

        //$Request = new \Illuminate\Http\Request();
		//$Request->ip();
		$user_ip = Request::ip();
		
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$user_ip));
        //$user_ip = $geo["geoplugin_request"];
		$ip_country = $geo["geoplugin_countryName"];
		
		$user = new \App\User();
        $adminDetails = $user->find(Session::get('admin_user')->id);
        $admin_id = $adminDetails['id'];
        $admin_email = $adminDetails['email'];
        $id = DB::table('admin_log')->insertGetId(
                ['ip_address' => $user_ip, 'ip_country' => $ip_country, 'module_name' => $module_name, 'action' => $action, 'admin_id' => $admin_id, 'admin_email' => $admin_email]);
    }
        
}