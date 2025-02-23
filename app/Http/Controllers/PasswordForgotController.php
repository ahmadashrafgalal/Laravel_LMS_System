<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;


class PasswordForgotController extends Controller
{
    public function index(): View{
        $title = 'forgot-password';
        return view('password_forgot.index', compact('title'));
    }
}
