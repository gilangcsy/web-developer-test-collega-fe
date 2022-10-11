<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $login = Http::post('http://localhost:3001/v1/auth/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        $login = json_decode($login->body());

        if ($login->success){
            $request->session()->put('token', $login->credentials->token);
            $request->session()->put('email', $login->credentials->email);
            $request->session()->put('id', $login->credentials->id);
			
            return redirect()->route('dashboard.index')->with('status', 'Welcome, ' . $login->credentials->email);
        } else {
            return redirect()->route('auth.index')->with('error', $login->message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $logout = Http::post('http://localhost:3001/v1/auth/logout', [
            'jwtToken' =>  $request->session()->get('token')
        ]);
        $logout = json_decode($logout->body());
        if ($logout->success){
            session()->flush();
            return redirect()->route('auth.index')->with('status', 'Logout has been successfully.');
        } else {
            return redirect()->route('auth.index')->with('status', $login->message);
        }
    }
}
