<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\KoffnesStatus;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CheckKoffnesStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek status dari cache, jika tidak ada ambil dari database
        $koffnesStatus = Cache::remember('status_koffnes', 60, function () {
            return KoffnesStatus::first();
        });

        // Jika status adalah 'close', redirect ke halaman closed
        if (!$koffnesStatus || $koffnesStatus->status_koffnes === 'close') {
            return redirect()->route('closed.page');
        }
        
        return $next($request);
    }
}
