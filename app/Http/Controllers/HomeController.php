<?php

namespace App\Http\Controllers;

use DB;
use Request;
use App\Models\UserPagesVisits;
use App\Categories as HomeCategories;
Use Cookie;
use Response;


class HomeController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
        
       $data['metas'] = get_page_meta_array();
        $data['cat_rel_data'] = DB::table('settings')
                ->where('key', 'cat_rel_data')
                ->first();
        $data['try_it_free_icon'] = DB::table('settings')
                ->where('key', 'try_it_free_icon')
                ->first();
        $data['homeCategories'] = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                        ->leftJoin(DB::RAW('(SELECT main_categories , count(main_categories) as total_request FROM `request_service` group by main_categories) as rs'), 'rs.main_categories', '=', 'c.id')
                        ->leftJoin(DB::RAW('(SELECT parent_id,id , count(parent_id) as total_business FROM `category` group by parent_id) as ct'), function($join) {

                            $join->on('ct.parent_id', '=', 'c.id');
                        })
                        ->select("c.id", "c.slug", "c.category_icon", "cd.name", "rs.total_request", "ct.total_business")->where('c.parent_id', 0)->where("featured", 1)
                        ->orderBy('c.id', 'DESC')->take(4)->get();
        $data['latest_requests'] = DB::table('request_service as rs')
                        ->leftJoin('users as u', 'rs.buyer_id', '=', 'u.id')
                        ->leftJoin('provinces as p', 'rs.state', '=', 'p.id')
                        ->leftJoin('cities as c', 'rs.city', '=', 'c.id')
                        ->Join('category_description as cd', function ($join) {
                            $join->on('cd.category_id', '=', 'rs.main_categories');
                        })
                        ->Join('category_description as cdsub', function ($join) {
                            $join->on('cdsub.category_id', '=', 'rs.sub_categories');
                        })
                        ->select("rs.id AS request_id", "rs.title AS request_title", "u.first_name", "u.last_name", "p.iso", "c.name AS city_name", "rs.created_at", "rs.description", "rs.budget_type", "rs.estimated_budget", "cd.name as mainCat", "cdsub.name as subCat")
                        ->where('rs.status', 1)
                        ->where('rs.show_on_home', 0)
                        ->orderBy('rs.id', 'DESC')->take(6)->get();
        $data['top_service_provider'] = DB::table('users')
                ->where('top_supplier', 1)
                ->take(8)
                ->get();
        $data['subcategories'] = HomeCategories::getServices(0, 18);
        $data['totalservices'] = HomeCategories::getTotalServices();
        //return response()->json($data);
        return view('home', $data);
    }
	
	public static function getservices () {
		return $data['names'] = HomeCategories::getServices(0, 18);
	//    return view('partials.footer')->with($data);
	}

    public function latest() {
        $data['metas'] = get_page_meta_array();
        $data['cat_rel_data'] = DB::table('settings')
                ->where('key', 'cat_rel_data')
                ->first();
        $data['homeCategories'] = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                        ->leftJoin(DB::RAW('(SELECT main_categories , count(main_categories) as total_request FROM `request_service` group by main_categories) as rs'), 'rs.main_categories', '=', 'c.id')
                        ->leftJoin(DB::RAW('(SELECT parent_id,id , count(parent_id) as total_business FROM `category` group by parent_id) as ct'), function($join) {

                            $join->on('ct.parent_id', '=', 'c.id');
                        })
                        ->select("c.id", "c.slug", "c.category_icon", "cd.name", "rs.total_request", "ct.total_business")->where('c.parent_id', 0)->where("featured", 1)
                        ->where('status', 1)
                        ->orderBy('id', 'DESC')->take(6)->get();
        $data['latest_requests'] = DB::table('request_service as rs')
                        ->leftJoin('users as u', 'rs.buyer_id', '=', 'u.id')
                        ->leftJoin('provinces as p', 'rs.state', '=', 'p.id')
                        ->leftJoin('cities as c', 'rs.city', '=', 'c.id')
                        ->leftJoin('category_description as cd', function ($join) {
                            $join->on('cd.category_id', '=', 'rs.main_categories');
                        })
                        ->leftJoin('category_description as cdsub', function ($join) {
                            $join->on('cdsub.category_id', '=', 'rs.sub_categories');
                        })
                        ->select("rs.id AS request_id", "rs.status", "rs.status as approve", "rs.title AS request_title", "u.first_name", "u.last_name", "p.iso", "c.name AS city_name", "rs.created_at", "rs.description", "rs.estimated_budget", "cd.name as mainCat", "cdsub.name as subCat")
                        ->where('rs.status', 1)
                        ->orderBy('request_id', 'DESC')->take(6)->get();
        $data['top_service_provider'] = DB::table('users')
                ->where('top_supplier', 1)
                ->take(8)
                ->get();
        return view('home', $data);
    }

}
