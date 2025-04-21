<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userRole = auth()->user()->role;

        if ($userRole === 'superAdmin' || $userRole === 'admin') {
            return $next($request);
        }
        abort(403, 'У вас недостаточно прав для этой страницы!');
    }
}
