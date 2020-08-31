<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckPermissions
{

    public function handle($request, Closure $next)
    {
        $current_page = Route::current()->getName();

        $page   = Str::before($current_page, '.');
        $action = Str::after($current_page, '.');


        return $next($request);
    }
}
