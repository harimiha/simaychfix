<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class ValidatePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null, $route = 'dashboard'): Response
    {
        $permission      = $request->route()->getName();
        $exist           = Permission::where('slug',$permission)->exists();

        if(!Auth::guard($guard)->guest() && (!$permission || !$exist || $request->user($guard)->can($permission))){
            return $next($request);
        }
        return $request->ajax ? response()->json('Unauthorized.',401) : redirect()->route($route)->with('message', ['status'=>'danger','desc'=>"Anda tidak memiliki hak untuk mengakses menu/tombol tersebut"]);
    }
}
