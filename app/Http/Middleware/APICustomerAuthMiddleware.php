<?php

namespace App\Http\Middleware;

use App\Http\Controllers\APITokenController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class APICustomerAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->route('id');
        $token = APITokenController::getCustomerAccess($id);

        if (!APITokenController::isValid($token))
            APITokenController::refreshCustomerAccess($id);

        return $next($request);
    }
}
