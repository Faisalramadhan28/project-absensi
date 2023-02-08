<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param
     */

    public function login(Request $request){
        info('controller LoginController login ----------');

        $username = $request->input('username');
        $password = $request->input('password');

        session(['username' => $username, 'password' => $password]);

        return redirect("/dashboard");
    }

    public function logout(){
        info('controller LoginController logout ----------');
        session()->flush();
        return redirect('/auth/login');
    }
}
