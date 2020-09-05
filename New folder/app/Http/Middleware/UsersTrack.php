<?php namespace App\Http\Middleware;

use Closure;
use App\Models\UserPagesVisits;

class UsersTrack {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
            if ($request->url() === url('') || $request->url() === url('suppliers')) {
                $ip = get_user_ip();
                $page = $request->getPathInfo();
                
                $existingVisit = UserPagesVisits::where('page', $page)->where('ip', $ip)->whereRaw('DATE(created_at) = CURDATE()')->first();
                
                if (is_null($existingVisit)) {
                    $country = '';
                    $state = '';
                    $city = '';
                    
                    $userIPDetails = unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
                    if($userIPDetails && $userIPDetails['status'] == 'success') {
                        $country = $userIPDetails ['country'];
                        $state = $userIPDetails ['regionName'];
                        $city = $userIPDetails ['city'];
                    }
                    
                    UserPagesVisits::create (['ip' => $ip, 'count' => 1, 'page' => $page, 'city' => $city, 'state' => $state, 'country' => $country]);
                } else {
                    $existingVisit->count += 1;
                    $existingVisit->save();
                }
            }
            return $next($request);
	}

}
