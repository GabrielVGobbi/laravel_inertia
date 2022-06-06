<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $model)
    {
        if (auth()->check()) {
            $user = auth()->user();

            if ($user->hasRole('dev')) {
                return $next($request);
            };

            switch (Route::getCurrentRoute()->getActionMethod()) {
                case 'index':
                    $permission = $user->can("view-$model");
                    break;
                case 'show':
                    $permission = $user->can("view-$model");
                    break;
                case 'store':
                    $permission = $user->can("store-$model");
                    break;
                case 'update':
                    $permission = $user->can("updated-$model");
                    break;
                case 'destroy':
                    $permission = $user->can("destroy-$model");
                    break;
                default:
                    $permission = $user->can("view-$model");
                    break;
            }

            return $permission ? $next($request) : abort(403);
        }
    }
}
