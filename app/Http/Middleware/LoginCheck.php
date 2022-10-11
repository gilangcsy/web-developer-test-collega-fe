<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            return $next($request);
        } else {
            $response = Http::post('http://localhost:3001/v1/auth/checkToken', [
                'token' => session()->get('token')
            ]);
            $response = json_decode($response->body());
            if($response->success) {
                return redirect(route('dashboard.index'))->with('status', 'You already logged in.');
            } else {
                session()->flush();
                return redirect()->route('auth.index')->with('error', 'Your session is expired. You have to login again.');
            }
        }
    }
}
