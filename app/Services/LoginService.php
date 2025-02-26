<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;


class LoginService
{
    
    public function authenticate($request): bool{
        $username = $request->string('username');
        $password = $request->string('password');
        $rememberMe = $request->string('remember_me');

        return Auth::attempt([ 'username' => $username,'password' => $password, 'active' => '1' ], $rememberMe);

    }
}
