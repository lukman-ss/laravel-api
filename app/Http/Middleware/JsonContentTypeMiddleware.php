<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Resources\Main\MainResource;

use App\Enums\StatusAPI;


class JsonContentTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the request content type is not application/json
        if ($request->header('Accept') !== 'application/json') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
