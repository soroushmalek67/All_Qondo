<?php
namespace App\Http\Controllers\Admin\Auth;

use DB;
use Session;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\RegisterRequest;

class AuthController extends Controller {

    /**
     * the model instance
     * @var User
     */
    protected $user; 
    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator  $auth
     * @return void
     */
    public function __construct(Guard $auth, User $user) {
        $this->user = $user; 
        $this->auth = $auth;

        if (count(Session::get('admin_user')) > 0) {
            return redirect('admin-panel');
        }
    }

    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function getRegister() {
        return view('admin.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  RegisterRequest  $request
     * @return Response
     */
    public function postRegister(RegisterRequest $request)
    {
        //code for registering a user goes here.
        $this->user->email = $request->email;
        $this->user->password = bcrypt($request->password);
        $this->user->save();
        $this->auth->login($this->user); 
        return redirect('/admin-panel'); 
    }

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  LoginRequest  $request
     * @return Response
     */
    public function postLogin(LoginRequest $request) {
//        var_dump($request->only('password'));exit;
        $user = DB::table('users')->Where("email", $request->only('email'))->Where("password", $request->only('password'))->get();
        
        if (count($user) > 0) {
            Session::put('admin_user', $user[0]);
            return redirect('/admin-panel');
        }
        
        return redirect('/admin-panel/auth/login')->withErrors([
            'email' => 'The credentials you entered did not match our records. Try again?',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout() {
        Session::forget("admin_user");
        return redirect('/admin-panel/auth/login');
    }

}