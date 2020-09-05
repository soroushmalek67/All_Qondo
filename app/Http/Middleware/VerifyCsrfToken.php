<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	
	public function handle($request, Closure $next)
	{
		if ($request->is('api/*') || $request->is('api_v2/*')) {
//            echo 'in';exit;
            return $this->addCookieToResponse($request, $next($request));
        }

       
		return parent::handle($request, $next);

	
	}

}
