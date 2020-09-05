<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth) {
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if ($this->auth->guest()) {
			if ($request->ajax()) {
				return response('Unauthorized.', 401);
			} else {
				return redirect()->guest('/auth/login');
			}
		}
// 		printr($this->auth->user());exit;
		if ((Request::isMethod('post') && Route::getCurrentRoute()->getPath() == 'profile')) {
			return $next($request);
		} else if (Route::getCurrentRoute()->getPath() != 'complete-profile' && $this->auth->user()->status == 2 && ($this->auth->user()->user_type == 2 || $this->auth->user()->user_type == 3)) {
			return redirect('complete-profile');
		} else {
			return $next($request);
		}
	}

}
