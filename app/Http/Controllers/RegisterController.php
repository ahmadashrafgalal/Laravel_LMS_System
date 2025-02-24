<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;
use GuzzleHttp\Psr7\Query;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller{
    protected object $service;

    public function __construct(RegisterService $service){
        $this->service = $service;
    }

    public function index(): View{
        $title = 'register';
        return view('register.index', compact('title'));
    }

    public function register(RegisterRequest $request): RedirectResponse{
        // dd($request);
        try{
            DB::beginTransaction();
                $this->service->register($request);
            DB::commit();

            return redirect()->back()->with('success', 'User has been registered successfully');
        }catch(QueryException | \Exception $e){
            DB::rollBack();
            Log::error($e);
            return redirect()->back()->withInput()->with('error', $e -> getMessage());
        }
    }
}
