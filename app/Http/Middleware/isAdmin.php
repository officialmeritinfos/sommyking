<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->is_admin!=1){
            Auth::logout();
            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect()->to(route('login'))->with('error','You are not authorized to access this page. Contact support');
        }else{

            if($user->twoWayPassed!=1){
                Auth::logout();
                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect()->to(route('login'))->with('error','You are not authorized to access this page. Contact support');
            }else{
                return $next($request);
            }
        }
    }
}
