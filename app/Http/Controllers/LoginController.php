<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(): View{
        $title = 'login';
        return view('login.index', compact('title'));
    }
}
