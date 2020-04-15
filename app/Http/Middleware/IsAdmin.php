<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Response;

class IsAdmin
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
        $user = auth()->user();
        if($user->roles[0]->name === User::ADMIN_ROLE){
            return $next($request);
        }

        return response()->json('No Access', Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
