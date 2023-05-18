<?php

namespace App\Http\Middleware;

use App\Http\Controllers\APITokenController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class APIAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = APITokenController::get(Auth::user()->id, 'User', 'Access');

        if (!APITokenController::isValid($token))
            APITokenController::refreshUserAccess(Auth::user()->id);

        return $next($request);
    }
}
