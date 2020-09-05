<?php namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Input;
use App\Http\Requests\Users\RequestMessage;


class Unsubscribe extends Controller {
    
    protected $userid;
    
    public function __construct() {
        $this->userid = Auth::id();
    }
    
    public function Index() {
        $data['metas'] = get_page_meta_array('Unsubscribe');
        $data['updated'] = false;
        $data['subscriptions'] = DB::table('emails_subscription')->where('userid', $this->userid)->first();
        return view('users.unsubscribe', $data);
    }
    public function Save() {
        $data['metas'] = get_page_meta_array('Unsubscribe');
        $data['updated'] = true;
        
//        print_r(Input::has('request_notification'));
//        exit();
        
        
        if (!Input::has('request_notification')) {Input::merge(['request_notification' => 0]);}
        if (!Input::has('quote_notification')) {Input::merge(['quote_notification' => 0]);}
        if (!Input::has('message_notification')) {Input::merge(['message_notification' => 0]);}
        if (!Input::has('quotes_left_notification')) {Input::merge(['quotes_left_notification' => 0]);}
        
        DB::table('emails_subscription')->where('userid', $this->userid)->update(Input::except('_token'));
        
        return view('users.unsubscribe', $data);
    }

}