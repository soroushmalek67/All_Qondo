<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Session;

class AuthController extends Controller {
	
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;
        
        protected $redirectTo = "/dashboard";
//        protected $redirectPath = "/dashboard";

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar) {
            	//print_r($registrar);exit();
                if (Session::has('requesServiceValues')) {
                    $this->redirectTo = "/request-service/save";
//                    ->intended('defaultpage');
                }
                
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
                
                
//                // Change user provider in auth
//                $userprovider = new \Illuminate\Auth\EloquentUserProvider(app('hash'), 'App\Other_model_there');
//                $this->auth->setProvider($userprovider);
//
//                // Second attempt with other model
//                if ($this->auth->attempt($credentials, $request->has('remember')))
//                {
//                    return redirect()->intended($this->redirectPath());
//                }
                
	}

}
