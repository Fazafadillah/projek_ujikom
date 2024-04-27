<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Http\RedirectResponse; // Import RedirectResponse class


class cekUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rules): Response
    {
        $user = Auth::user();

        if (!Auth::check()) {
            return redirect('login');
        }
        if ($user->level == $rules)
            return $next($request);

        return redirect('login')->with('error', 'Kamu tidak ada ada hak akses');
    }
}
