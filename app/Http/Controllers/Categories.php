<?php namespace App\Http\Controllers;

use DB;
use App\ModelCities;

class Categories extends Controller {
    
    public function index() {
        $data['metas'] = get_page_meta_array('Main Categories');
        
        $data['categories'] = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                            ->select("c.id", "c.slug", "c.image", "cd.name", "cd.description")->where('c.parent_id', 0)
                            ->orderBy('c.featured', 'desc')->orderBy('c.id', 'desc')->get();
        $data['cities'] = ModelCities::leftJoin('provinces as s', 's.id', '=', 'cities.state')->select('cities.*', 's.iso')
                                    ->orderBy('id', 'desc')->where('featured', 1)->get();
        return view('categories', $data);
    }

    public function subCategories($slug) {
        $data['categoryDetails'] = DB::table('category as c')->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                                    ->select("cd.name", "cd.description", "c.image", 'meta_title', 'meta_keywords', 'meta_description')
                                    ->where('c.slug', $slug)->first();
        
        $data['metas'] = get_page_meta_array(((empty($data['categoryDetails']->meta_title))?$data['categoryDetails']->name:$data['categoryDetails']->meta_title), 
                                                    $data['categoryDetails']->meta_keywords, $data['categoryDetails']->meta_description);
        
        $featuredCatsids = array();
        $data['featuredCategories'] = DB::table('category as c')->leftJoin('category as c2', 'c2.id', '=', 'c.parent_id')
                            ->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')->select("c.id", "c.slug", "c.category_icon", 
                            DB::raw("(SELECT name FROM category_description WHERE c2.id = category_id LIMIT 1) as parentName"), "cd.name")
                            ->where('c2.slug', $slug)->where("c.featured" ,'1')->orderBy('c.id', 'DESC')->take(5)->get();
        
        foreach ($data['featuredCategories'] as $featuredCategory) {
            $featuredCatsids[] = $featuredCategory->id;
        }
        
        $data['childCategories'] = DB::table('category as c')->leftJoin('category as c2', 'c2.id', '=', 'c.parent_id')
                            ->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')->select("c.id", "c.slug", "c.image", "cd.name")
                            ->where('c2.slug', $slug)->whereNotIn('c.id', $featuredCatsids)->orderBy('c.id', 'DESC')->get();
            
        $data['featuredSuppliers'] = DB::table('users as u')
                                        ->leftJoin(DB::raw('(SELECT * FROM category WHERE parent_id = 0) as c')
                                                , DB::raw('FIND_IN_SET(c.id, u.main_categories)'), DB::raw(''), DB::raw(''))
//                                        ->leftJoin('category_description as cd', 'c.id', '=', 'cd.category_id')
                                        ->leftJoin(DB::raw('(SELECT count(id) quotesAccepted, supplier_id FROM quotes WHERE status = 1 '
                                                        .'GROUP BY supplier_id) as q')
                                                , 'q.supplier_id', '=', 'u.id')
                                        ->leftJoin('cities as c2' , 'c2.id', '=', 'u.city')->leftJoin('provinces as s' , 's.id', '=', 'u.state')
                                        ->select("u.id", "u.business_name", 'c2.name as city', 's.name as state', 'u.company_logo', 'u.created_at', 
                                                'q.quotesAccepted', 'u.company_slug')
                                        ->where("c.slug", $slug)->where(function ($join) {
                                            $join->orWhere('u.user_type', 2);
                                            $join->orWhere('u.user_type', 3);
                                        })->where(function ($query) {
								            $query->where('u.status', 1)->orWhere('u.status', 6);
								        })
                                        ->groupBy('u.id')
                                        ->orderBy('q.quotesAccepted', 'DESC')
                                        ->take(3)
                                        ->get();
//        printr($data['featuredSuppliers']);exit;
        
        return view('sub_categories', $data);
    }

}
