<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!filter_var($request->img_url, FILTER_VALIDATE_URL)) {
            return redirect('/')
                ->with('error', 'La URL de la imagen no es válida.');
        }
        return $next($request);
    }
}
