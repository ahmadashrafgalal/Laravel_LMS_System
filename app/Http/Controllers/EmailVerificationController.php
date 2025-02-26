<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function VerifyEmail(EmailVerificationRequest $request){
        $request->fulfill();
        $user = $request->user();
        $user->active = 1;
        $user->save();
    }

    public function Verification_notice(Request $request){
        $title = 'Email Verification';
        return view('verification.notice', compact('title'));
    }


}
