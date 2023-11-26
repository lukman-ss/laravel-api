<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Enums\StatusAPI;

use App\Http\Resources\Main\MainResource;

class HttpMethodMismatchMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the route for the current request
        $route = $request->route();

        // Check if a route is matched
        if ($route instanceof Route) {
            // Get the expected method for the route
            $expectedMethod = $route->getActionMethod();

            // Get the actual method of the incoming request
            $actualMethod = $request->method();

            // Check if the methods match
            if ($expectedMethod !== $actualMethod) {
                // If not, return a Forbidden response
                return response()->json(['error' => 'FORBIDDEN'], 403);
            }
        } else {
            // Handle the case when no route is matched
            return response()->json(['error' => 'FORBIDDEN'], 403);
        }

        return $next($request);
    }
}
