<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use DB;

class access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $usertype = Auth::user()->user_type_id;
        $routeName = explode("/", $request->route()->uri);
        $routeName = $routeName[0];
        $access = DB::table('user_access as ua')->leftJoin('modules as m', 'ua.module_id', '=', 'm.id')->where('ua.user_type_id', $usertype)->where('m.routes', $routeName)->first();
              
            if (!$access) {
                abort(409, 'Module not registerd.');
            }else if($access->grant == 0){
                abort(401, 'Access denied'); 
            }
        
        return $next($request);
    }
}
