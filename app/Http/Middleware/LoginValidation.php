<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LoginValidation
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
        info("middleware LoginValidation ----------");
        $response = $next($request);

        if(Session::get('username')){
            $username = Session::get('username');
            $password = Session::get('password');

            $user = DB::table('tb_users')->where('username', $username)->where('password', $password)->get('*');

            if(count($user) == 1){
                session(['nama_user' => $user[0]->nama]);
                return $response;
            }
        }

        return redirect("/auth/logout");
    }
}
