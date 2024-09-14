<?php

namespace App\Http\Middleware;

use App\Enums\UserStatus;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ActiveUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = auth()->user();
        if($user === null){
            abort(404);
        }

        if($user->status === UserStatus::blocked->value){
            abort(403 , __("This account is blocked"));
        }

        if($user->status === UserStatus::inactive->value){
            abort(403 , __("This account is inactive"));
        }

        return $next($request);
    }
}
