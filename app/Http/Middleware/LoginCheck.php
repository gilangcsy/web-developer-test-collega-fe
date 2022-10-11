<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginCheck
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
        if(empty(session()->get('token'))) {
            // $response = Http::post($this->url_dynamic() . 'auth/checkToken', [
            //     'token' => session()->get('token')
            // ]);
            // $response = json_decode($response->body());
            // if($response->success) {
            //     return $next($request);
            // } else {
            //     session()->flush();
            //     return redirect()->route('auth.index')->with('error', 'Your session is expired. You have to login again.');
            // }
            
            return $next($request);
        } else {
            return redirect(route('dashboard.index'))->with('status', 'You already logged in.');
        }
    }
}
