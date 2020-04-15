<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Response;

class MustBeThemselves
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
        $app_code_from_req = $request->route()->parameters['vendor']->app_code;
        $user_id = $request->route()->parameters['user']->id;
        $app_code = $request->session()->get('app_code');

        if($user_id === auth()->user()->id && $app_code_from_req === $app_code){
            return $next($request);
        }

        return response()->json(Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
