<?php namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use File;
use App\Categories;
use App\User;
use App\productModel;
use App\couponModel;
use App\ModelStates;
use App\Http\Requests\Users\ProfileRequest;
use App\Http\Requests\Users\productRequest;
use App\Http\Requests\Users\couponRequest;

class Dedicated extends Controller {
    protected $viewData = array();
    protected $userid;
 
    
    public function __construct() {
        $this->viewData['userType'] = Auth::userType();
        $this->userid = Auth::id();

//        $totalNewMessages = User::rightJoin('messages as m', 'm.sender_id', '=', 'users.id')->leftJoin('quotes as q', 'q.id', '=', 'm.quote_id')
//                                ->leftJoin('request_service as rs', 'rs.id', '=', 'q.request_id')->select(DB::raw('COUNT(m.id) as newMessages'))
//                                ->where('users.id', '!=', $this->userid);
        $this->viewData['dashboardUser'] = "Supplier";
        $this->viewData['userPostType'] = "Quote";
        $this->viewData['userPostResponser'] = "Buyer";

        if ($this->viewData['userType'] == 1) {
            $this->viewData['dashboardUser'] = "Buyer";
            $this->viewData['userPostType'] = "Request";
            $this->viewData['userPostResponser'] = "Supplier";
        }
    }
    
    public function dedicated_url_not_found() {
        $data = $this->viewData;
        $data['userDetails'] = User::find(Auth::id());
        $data['metas'] = get_page_meta_array($data['dashboardUser'].' Dashboard');
        return view('no_dedicated_url', $data);
    }
    
    public function dedicated_url($url) {
        echo $url;exit;
    }
}
