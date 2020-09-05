<?php namespace App\Http\Controllers;

use DB;
use App\ModelCities;

class Cities extends Controller {
    
    public function index($slug) {
        $data['cityDetails'] = ModelCities::where('slug', $slug)->first()->toArray();
        
        $data['metas'] = get_page_meta_array(((empty($data['cityDetails']['meta_title']))?$data['cityDetails']['name']:$data['cityDetails']['meta_title']), 
                                                    $data['cityDetails']['meta_keywords'], $data['cityDetails']['meta_description']);
            
        $data['featuredCategories'] = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                                        ->leftJoin('users as u', DB::raw('FIND_IN_SET(c.id, u.sub_categories)'), DB::raw(''), DB::raw(''))
                                        ->leftJoin('cities as ci', DB::raw('FIND_IN_SET(ci.id, u.service_cities)'), DB::raw(''), DB::raw(''))
                                        ->select("c.id", "c.slug", "c.category_icon", "cd.name", 'u.id as userid', 'u.sub_categories'
                                                , 'ci.id as cityid', 'u.service_cities', 'c.featured', 'ci.name as cityName')
                                        ->where('ci.id', '!=', '')->where("u.id", '!=', '')->where("ci.slug", $slug)
                                        ->where("c.featured" ,'1')->groupBy('c.id')->orderBy('c.id', 'DESC')->take(5)
                                        ->get();
        
        $featuredCatsids = array_map(function($array){return $array->id;}, $data['featuredCategories']);
        
//        foreach ($data['featuredCategories'] as $featuredCategory) {
//            $featuredCatsids[] = $featuredCategory->id;
//        }
        
        $data['childCategories'] = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                                        ->leftJoin('users as u', DB::raw('FIND_IN_SET(c.id, u.sub_categories)'), DB::raw(''), DB::raw(''))
                                        ->leftJoin('cities as ci', DB::raw('FIND_IN_SET(ci.id, u.service_cities)'), DB::raw(''), DB::raw(''))
                                        ->select("c.id", "c.slug", "c.category_icon", "cd.name", 'u.id as userid', 'u.sub_categories'
                                                , 'ci.id as cityid', 'u.service_cities', 'c.featured', 'ci.name as cityName')
                                        ->where('ci.id', '!=', '')->where("u.id", '!=', '')->where("ci.slug", $slug)
                                        ->whereNotIn('c.id', $featuredCatsids)->groupBy('c.id')->orderBy('c.id', 'DESC')->take(5)
                                        ->get();
            
        $data['featuredSuppliers'] = DB::table('users as u')
                                        ->leftJoin('cities as c' , DB::raw('FIND_IN_SET(c.id, u.service_cities)'), DB::raw(''), DB::raw(''))
                                        ->leftJoin(DB::raw('(SELECT count(id) quotesAccepted, supplier_id FROM quotes WHERE status = 1 '
                                                        .'GROUP BY supplier_id) as q')
                                                , 'q.supplier_id', '=', 'u.id')
                                        ->leftJoin('cities as c2' , 'c2.id', '=', 'u.city')->leftJoin('provinces as s' , 's.id', '=', 'u.state')
										->leftJoin('category as ct', DB::raw('FIND_IN_SET(ct.id, u.main_categories)'), '=', 'ct.id')
                                        ->select("u.id", "u.business_name", 'c2.name as city', 's.name as state', 'u.company_logo', 'u.created_at', 
                                                'q.quotesAccepted', 'u.company_slug')
                                        ->where(function ($join) use ($slug) {
                                            $join->where("c.slug", $slug);
                                            $join->where("c2.slug", $slug);
                                        })->where(function ($join) {
                                            $join->orWhere('u.user_type', 2);
                                            $join->orWhere('u.user_type', 3);
                                        })->where(function ($query) {
								            $query->where('u.main_categories', '!=', '')->where('u.status', 1)->orWhere('u.status', 6);
								        })
                                        ->groupBy('u.id')
                                        ->orderBy('q.quotesAccepted', 'DESC')
                                        ->take(3)
                                        ->get();
        
        return view('cities', $data);
    }

}