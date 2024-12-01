<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $roles)
    {
        $userRole = Session::get('role');

        if (!$userRole) {
            return redirect('/login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        $allowedRoles = explode('|', $roles);
        if (!in_array($userRole, $allowedRoles)) {
            return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
