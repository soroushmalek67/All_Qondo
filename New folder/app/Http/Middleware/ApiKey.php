<?php namespace App\Http\Middleware;

use Closure;
use Session;
use Route;
use Illuminate\Contracts\Auth\Guard;

class ApiKey {

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
            $api_key = $request->get('api_key');
            
            if ($api_key != API_KEY) {
                $data['Response'] = 'error';
                $data['Message'] = "Please provide app key";
                $data['Status'] = "400";
                return response()->json($data);
            }
		return $next($request);
	}

}
