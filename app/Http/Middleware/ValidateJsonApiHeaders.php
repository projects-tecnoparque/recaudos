<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateJsonApiHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->header('accept') !== 'application/vnd.api+json'){
            throw new HttpException(406, __('Not Acceptable'));
        }

        if($request->isMethod('POST') || $request->isMethod('PATCH') || $request->isMethod('PUT')){
            if($request->header('content-type') !== 'application/vnd.api+json'){
                throw new HttpException(415, __('Unsupported Media Type'));
            }
        }
        $response = $next($request);

        $response->headers->set(
            'content-type', 'application/vnd.api+json'
        );
        return $response;
    }
}
