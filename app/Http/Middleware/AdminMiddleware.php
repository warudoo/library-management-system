<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| MIDDLEWARE ADMIN
|--------------------------------------------------------------------------
|
| Hanya meneruskan request jika user login DAN role-nya admin.
| Selain itu, dilempar balik ke dashboard dengan pesan error.
*/
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'Anda tidak punya akses.');
    }
}
