<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;


class RegisterController extends Controller
{
    public function index(): View{
        $title = 'register';
        return view('register.index', compact('title'));
    }
}
