<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use Input;
use App\User;
use App\Categories;
use App\ModelCities;
use App\ModelStates;

class Supplier extends Controller {
    
    protected $viewData = array();
    protected $userid;
    
    public function __construct() {
        $this->viewData['userType'] = Auth::userType();
        $this->userid = Auth::id();

        $this->viewData['dashboardUser'] = "Supplier";
        $this->viewData['userPostType'] = "Quote";
        $this->viewData['userPostResponser'] = "Buyer";

        if ($this->viewData['userType'] == 1) {
            $this->viewData['dashboardUser'] = "Buyer";
            $this->viewData['userPostType'] = "Request";
            $this->viewData['userPostResponser'] = "Supplier";
        }
    }
    
    public function Index () {
        $data = $this->viewData;
        return view("view_suppliers", $data);
    }
    
    public function AllSuppliers () {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('All Suppliers');
        
        $data['categories'] = Categories::getMainCategories();
        $data['linkedinIndustries'] = DB::table('linkedin_industries')->orderBy('name', "ASC")->get();
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        
        $data['filterValues'] = ['searchKeywork' => '', 'postal_code' => ''];
        if (Input::has('suppliersFilter')) {
            $searchKeywork = Input::get('searchKeywork');
            $postalCode = Input::get('postal_code');
            $data['filterValues'] = ['searchKeywork' => $searchKeywork, 'postal_code' => $postalCode];
        }
        
        $data['allSupplers'] = $this->SelectSuppliersQuery();
        $data['filterValues']['offset'] = count($data['allSupplers']);
//        printr($data['allSupplers']);exit;
        return view("all_suppliers", $data);
    }
    
    public function SelectSuppliersQuery () {
        $suplliersQueryBuilder = User::leftJoin(DB::raw('(SELECT count(id) quotesAccepted, supplier_id FROM quotes WHERE status = 1 GROUP BY supplier_id) as q')
                                                , 'q.supplier_id', '=', 'users.id')
                            ->leftJoin('cities as c2' , 'c2.id', '=', 'users.city')->leftJoin('provinces as s' , 's.id', '=', 'users.state')
                            ->select("users.id", "users.business_name", 'c2.name as city', 's.name as state', 'users.company_logo', 'users.company_slug', 
                                    DB::raw("DATE_FORMAT(users.created_at,'/%Y/%c/%d/') as created_at_formated"), 'q.quotesAccepted', 'users.created_at'
//                                    , 'cd.name as mainCat'
//                                    , 'cd2.name as subCat'
//                                    , 'ci.name as servicecity'
                                    );
        
        if (Input::has('suppliersFilter')) {
            $searchKeywork = Input::get('searchKeywork');
            $postalCode = Input::get('postal_code');
                
            if ($searchKeywork) {
                $suplliersQueryBuilder->leftJoin(DB::raw("(SELECT category_id, name FROM category_description WHERE name LIKE '%$searchKeywork%') as cd"), 
                                                DB::raw("FIND_IN_SET(cd.category_id, users.main_categories)"), DB::raw(""), DB::raw(""));
                $suplliersQueryBuilder->leftJoin(DB::raw("(SELECT category_id, name FROM category_description WHERE name LIKE '%$searchKeywork%') as cd2"), 
                                                DB::raw("FIND_IN_SET(cd2.category_id, users.sub_categories)"), DB::raw(""), DB::raw(""));
                $suplliersQueryBuilder->leftJoin(DB::raw("(SELECT id, name FROM cities WHERE name LIKE '%$searchKeywork%') as ci"), 
                                                DB::raw("FIND_IN_SET(ci.id, users.service_cities)"), DB::raw(""), DB::raw(""));
            
                $suplliersQueryBuilder->where(function ($query) use ($searchKeywork) {
                    $query->whereNotNull('ci.name')->orWhereNotNull('cd.name')->orWhereNotNull('cd2.name')
                            ->orWhere('users.business_name', "LIKE", "%$searchKeywork%");
                });
            }
            
            if ($postalCode) {
                $suplliersQueryBuilder->where('postal_code', $postalCode);
            }
        }
        
        $suplliersQueryBuilder->where(function ($query) {
            $query->where('user_type', 3)->orWhere('user_type', 2);
        })->where(function ($query) {
            $query->where('users.status', 1)->orWhere('users.status', 6);
        })->orderBy('q.quotesAccepted', 'DESC')->orderBy('id', 'DESC')->groupBy('users.id');
        
        if (Input::has('offset')) {
            $suplliersQueryBuilder->skip(Input::get('offset'));
        }
        
        return $suplliersQueryBuilder->take(30)->get()->toArray();
    }
    
}