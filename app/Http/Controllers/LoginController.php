<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\LoginService;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller {

    protected object $service;

    public function __construct(LoginService $service){
        $this->service = $service;
    }

    public function index(): View{
        $title = 'login';
        return view('login.index', compact('title'));
    }

    public function authenticate(LoginFormRequest $request): RedirectResponse{
        try{
            $isAuthenticated = $this -> service -> authenticate($request);

            if($isAuthenticated){
                return redirect()->route('home');
            }else{
                return redirect()->back('login')->withInput()->with('error', 'Invalid credentials');
            }

        }catch(\Exception | QueryException $e){
            Log::error($e);
            return redirect()->back('login')->withInput()->with('error', $e -> getMessage());
        }
        
    }

    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();
        return redirect()->route('login');
    }

}
