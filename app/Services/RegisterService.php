<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function register($request){
        return User::create([
            'role_id' => $request->input('role'),
            'first_name' => $request->input('first-name'),
            'last_name' => $request->input('last-name'),
            'email' => $request->input('email'),
            'username' => $this->username($request),
            'password' => Hash::make($request->input('password')),

        ]);
    }

    public function username($request){
        $first_name = $request->input('first-name');
        $last_name = $request->input('last-name');
        $slug = Str::slug($first_name . ' ' . $last_name);

        $user = User::where('username', 'LIKE', $slug . '%')->count();
        return $user > 0 ? $slug . '_' . ($user + 1) : $slug;

    }
}
