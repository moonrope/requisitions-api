<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JsonResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);  // after request completion get the controller response her

        if($response instanceof JsonResponse){
            $responseData = [
                'data' => $response->getData(),
                'status' => $response->status(),
                'api_version' => config('api.version'),
            ];

            $response->setData($responseData);
        }
        return $response;
    }
}
