<?php

namespace App\Http\Middleware;

use App\Http\Controllers\APITokenController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class APIUserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = APITokenController::getUserAccess();

        if (!APITokenController::isValid($token))
            APITokenController::refreshUserAccess();

        return $next($request);
    }
}
