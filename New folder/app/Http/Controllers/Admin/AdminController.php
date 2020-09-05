<?php
namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller {

    public function Index () {
        return view("admin.index");
    }
    
    public function NewsLetterEmails () {
        $data['subscribers'] = DB::table('newsletter')->paginate(25);
        return view("admin.newsletter", $data);
    }
        
}