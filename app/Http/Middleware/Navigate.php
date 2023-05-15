<?php

namespace App\Http\Middleware;

use App\Helpers\NavigationHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Navigate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $parameters = $request->route()->parameters();
        NavigationHelper::forward($parameters);

        return $next($request);
    }
}
