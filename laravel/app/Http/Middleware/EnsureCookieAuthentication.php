<?php

namespace App\Http\Middleware;

use App\Http\Controllers\UsersController;
use Closure;
use Illuminate\Http\Request;

class EnsureCookieAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $controller = new UsersController();
        $user = $controller->retrieveUserFromCookieToken();

        if($user == null){
            return response()->json(["success" => false, "message" => "unauthenticated"]);
        }
        
        return $next($request);
    }
}
