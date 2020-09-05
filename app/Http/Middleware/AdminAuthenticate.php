<?php namespace App\Http\Middleware;

use Closure;
use Session;
use Route;
use Illuminate\Contracts\Auth\Guard;

class AdminAuthenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $user;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct() {
            $this->user = count(Session::get('admin_user'));
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
            if (Route::getCurrentRoute()->getPath() == "admin-panel/auth/login/{one?}/{two?}/{three?}/{four?}/{five?}") {
                if ($this->user > 0) {
                    return redirect()->guest('admin-panel');
		}
            } else {
		if ($this->user == 0) {
                    if ($request->ajax()) {
                            return response('Unauthorized.', 401);
                    } else {
                            return redirect()->guest('admin-panel/auth/login');
                    }
		}
            }

		return $next($request);
	}

}
