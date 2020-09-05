<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use Input;
use Mail;
use App\User;
use App\Http\Requests\supplierRequest;
use App\Http\Requests\allSupplierlist;
use App\Categories;
use App\ModelCities;
use App\ModelStates;
use Illuminate\Http\Request;

//use DB;

class MySuppliers extends Controller {

    protected $viewData = array();
    protected $userid;

    public function __construct() {
        $this->viewData['userType'] = Auth::userType();
        $this->userid = Auth::id();

        $this->viewData['dashboardUser'] = "Condo Owner";
        $this->viewData['userPostType'] = "Contractor";
        $this->viewData['userPostResponser'] = "Contractor";
    }

    public function Index() {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('My Suppliers');

        $data['categories'] = Categories::getMainCategories();
        $data['userDetails'] = User::find($this->userid);

        return view("my_suppliers", $data);
    }

    public function allSupplier() {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('My Suppliers');
        $data['states'] = ModelStates::orderBy('name', 'ASC')->get();
        $data['categories'] = Categories::getMainCategories();
        $data['userDetails'] = User::find($this->userid);

        return view("allSupplierslist", $data);
    }

    public function add_supplierForm() {
        $data = $this->viewData;
        $data['metas'] = get_page_meta_array('My Suppliers');

        $data['categories'] = Categories::getMainCategories();
        $data['userDetails'] = User::find($this->userid);

        return view("addSupplier", $data);
    }

    public function saveSupplier($id, supplierRequest $request) {
        $buyer = User::find(Auth::id());
        $email = DB::table('users')->where('email', $request->get('email'))
                ->first();
        if ($email == null) {
            $id_get = DB::table('users')->insertGetId(['first_name' => $request->get('fname'), 'last_name' => $request->get('lname'), 'email' => $request->get('email'), 'status' => 0, 'phone_number' => $request->get('pnumber'), 'user_type' => 2, 'main_categories' => implode(",", $request->get('main_categories')), 'sub_categories' => implode(",", $request->get('sub_categories')), 'business_name' => $request->get('businuss'), 'added_by' => Auth::id()]);
            $admin_email = getSettings('notification_email');
            $addSupplierNotification = DB::table('notification')
                    ->where('notificationName', 'add_supplier')
                    ->first();
//                  $data['notification']=$registerNotification;
            $buyer = strtr($addSupplierNotification->content, ["@buyername" => $buyer->first_name, "@buyeremail" => $buyer->email, '@click_here' => url('unsubscribe')]);
            $data = ['emailbody' => $buyer];
            Mail::send('emails.csvInvetation', $data, function($message) use ($admin_email) {
                $message->to($admin_email)
                        ->subject('Supplier add');
                $message->from(SENDER_EMAIL, SENDER_NAME);
            });
            $match = DB::table('suplier_buyerrel')->where('supplier_id', $id_get)
                    ->where('buyer_id', Auth::id())
                    ->get();

            if ($match == null) {
                $id_get1 = DB::table('suplier_buyerrel')->insertGetId(['supplier_id' => $id_get, 'buyer_id' => Auth::id(), 'show_email' => 1]);
            }
        } else {
            $match = DB::table('suplier_buyerrel')->where('supplier_id', $email->id)
                    ->where('buyer_id', Auth::id())
                    ->get();
            if ($match == null) {
                $id_get1 = DB::table('suplier_buyerrel')->insertGetId(['supplier_id' => $email->id, 'buyer_id' => Auth::id(), 'show_email' => 1]);
            }
        }
        return redirect("supplier-buyer-list");
    }

    public function save_cvs($id, Request $request) {
        $buyer = User::find(Auth::id());
        $file = $request->file('csv');
        $sendMailFlag = 0;
        if ($file != null) {
            $handle = fopen($file, "r");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $email = DB::table('users')->where('email', $data[2])
                        ->first();
                if ($email == null) {
                    $id_get = DB::table('users')->insertGetId(['first_name' => $data[0], 'last_name' => $data[1], 'email' => $data[2], 'status' => 0, 'phone_number' => $data[3], 'user_type' => 2, 'business_name' => $data[4], 'postal_code' => $data[4], 'added_by' => Auth::id()]);
                    $sendMailFlag = 1;
                    $match = DB::table('suplier_buyerrel')->where('supplier_id', $id_get)
                            ->where('buyer_id', Auth::id())
                            ->get();
                    if ($match == null) {
                        $id_get1 = DB::table('suplier_buyerrel')->insertGetId(['supplier_id' => $id_get, 'buyer_id' => Auth::id(), 'show_email' => 1]);
                    }
                } else {
                    $match = DB::table('suplier_buyerrel')->where('supplier_id', $email->id)
                            ->where('buyer_id', Auth::id())
                            ->get();

                    if ($match == null) {
                        $id_get1 = DB::table('suplier_buyerrel')->insertGetId(['supplier_id' => $email->id, 'buyer_id' => Auth::id(), 'show_email' => 1]);
                    }
                }
                $email = "";
            }
            fclose($handle);
        }

        if ($sendMailFlag) {
            $admin_email = getSettings('notification_email');
            $addSupplierNotification = DB::table('notification')
                    ->where('notificationName', 'add_supplier')
                    ->first();

            $buyer = strtr($addSupplierNotification->content, ["@buyername" => $buyer->first_name, "@buyeremail" => $buyer->email, '@click_here' => url('unsubscribe')]);

            $data = ['emailbody' => $buyer];
            Mail::send('emails.csvInvetation', $data, function($message) use ($admin_email) {
                $message->to($admin_email)
                        ->subject('Supplier add');
                $message->from(SENDER_EMAIL, SENDER_NAME);
            });
        }
        return redirect("supplier-buyer-list");
    }

    public function save_listexit($id, allSupplierlist $request) {
        for ($i = 0; $i < count($request->get('suppliers')); $i++) {
            $match = DB::table('suplier_buyerrel')->where('supplier_id', $request->get('suppliers')[$i])
                    ->where('buyer_id', Auth::id())
                    ->get();
            if ($match == null) {
                DB::table('suplier_buyerrel')->insertGetId(['supplier_id' => $request->get('suppliers')[$i], 'buyer_id' => $id]);
            }
        }

        return redirect("supplier-buyer-list");
    }

    public function supplierlist(Request $request) {
        $data = $this->viewData;
        if ($request->get('main_categories') != null) {
//             $maincat=implode(",", $request->get('main_categories'));
            $maincat = $request->get('main_categories');
            $data['searchmain'] = $request->get('main_categories');
        } else {
            $maincat = "0";
            $data['searchmain'] = " ";
        }
        if ($request->get('sub_categories') != null) {
            $childcat = $request->get('sub_categories');
            $data['searchchild'] = $request->get('sub_categories');
        } else {
            $childcat = "0";
            $data['searchchild'] = "";
        }
        $data['metas'] = get_page_meta_array('My Contractor');
        $data['categories'] = Categories::getMainCategories();
        $data['Subcategories'] = Categories::getChildCategoriesByID($maincat);
        $data['AllSubCategories'] = Categories::getSubCategories();
        $data['userDetails'] = User::find($this->userid);
        $data['supplierlists'] = DB::table('suplier_buyerrel')
                //sohail changing
                ->leftjoin('users as u', 'u.id', '=', 'suplier_buyerrel.supplier_id')
                //sohail changing
                ->leftjoin('provinces as p', 'p.id', '=', 'u.state')
                ->leftjoin('cities as city', 'city.id', '=', 'u.city')
                ->where('buyer_id', Auth::id())
                ->where('added_by', 0)
                ->where(function ($query) use ($childcat, $maincat ) {
                    if (($childcat) != 0) {
                        $query->whereRaw('FIND_IN_SET(' . $childcat . ',u.sub_categories)');
                    }
                    if ($maincat != 0) {
                        $query->whereRaw('FIND_IN_SET(' . $maincat . ', u.main_categories)');
                    }
                })
                ->select('u.*', 'suplier_buyerrel.show_email', 'suplier_buyerrel.status as activation', 'p.name as provinceName', 'city.name as cityName')
                ->orderBy('suplier_buyerrel.id')->paginate(10)
                ->appends(['sub_categories' => $childcat, 'main_categories' => $maincat]);
        return view('BuyerSupplierList', $data);
    }

    public function delete($id) {
        $data['supplierlists'] = DB::table('suplier_buyerrel')
                ->where('buyer_id', Auth::id())
                ->where('supplier_id', $id)
                ->delete();
        return redirect("supplier-buyer-list");
    }

    public function activation($slug, $id) {
        if ($slug == 0) {

            $data['supplierlists'] = DB::table('suplier_buyerrel')
                    ->where('buyer_id', Auth::id())
                    ->where('supplier_id', $id)
                    ->update(['status' => 0]);
        } else {
            $data['supplierlists'] = DB::table('suplier_buyerrel')
                    ->where('buyer_id', Auth::id())
                    ->where('supplier_id', $id)
                    ->update(['status' => 1]);
        }
        return redirect("supplier-buyer-list");
    }

}
