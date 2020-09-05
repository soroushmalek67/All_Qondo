<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use App\User;
use App\reviewModel;
use Auth;
use App\emailSub;
use Illuminate\Http\Request;
use App\Http\Requests\reviewRequest;

//use Illuminate\Support\Facades\Request;
class SocialController extends Controller {

    public function index() {
        return;
    }

    public function sociallogin(Request $request) {
        $userclass = new User();
        $user = DB::table('users')
                ->where('email', $request->get('email_register'))
    //                    ->where('user_type', $request->get('userType'))
                ->first();
        
        if ($user == null) {
            $userclass->token = $request->get('_token');
            $userclass->first_name = $request->get('firstname');
            $userclass->last_name = $request->get('lstname');
            $userclass->email = $request->get('email_register');
            $userclass->user_type = $request->get('userType');
            $userclass->status = 2;
            $userclass->password = bcrypt($request->get('social_pass'));
            $userclass->save();

            $user = DB::table('users')
                    ->where('email', $request->get('email_register'))
//                    ->orwhere('email',$request->get('email'))
                    ->first();

            $emailSub = new emailSub();
            $emailSub->userid = $user->id;
            $emailSub->request_notification = 1;
            $emailSub->quote_notification = 1;
            $emailSub->message_notification = 1;
            $emailSub->quotes_left_notification = 1;
            $emailSub->save();
            
            solcialSignUp($request->get('email'), $user->id, $request->get('userType'));
            $request->session()->put('user_type', $request->get('userType'));
            return redirect()->intended('dashboard');
        } else {
            // Login with error if wrong user_type selected
            if ($user->user_type == 3 || $request->get('userType') == $user->user_type) {
                solcialSignUp($request->get('email'), $user->id, $request->get('userType'));
                $request->session()->put('user_type', $request->get('userType'));
                return redirect()->intended('dashboard');
            } else if ($user->user_type == 2) {
                return back()->withErrors("<strong>Wrong Type Selected:</strong> Your user type is Supplier.");
            } else if ($user->user_type == 1) {
                return back()->withErrors("<strong>Wrong Type Selected:</strong> Your user type is Buyer.");
            }
        }
//           $user->updateStatus();
        return;
    }
}
