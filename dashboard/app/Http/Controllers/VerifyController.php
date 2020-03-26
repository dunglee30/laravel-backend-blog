<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
class VerifyController extends Controller
{
    //
    public function VerifyEmail($token) {
        if($token == null){
            return redirect::intended('login')->with('error', 'Invalid Login attempt');
        }

        $user = User::where('email_verify_token', $token)->first();
        if($user == null) {
            return redirect::intended('login')->with('error', 'Invalid Activated attempt.');
        }

        $user->email_verified = 1;
        $user->email_verified_at = Carbon::now();
        $user->email_verify_token = '';
        $user->save();

        return redirect::intended('login')->with('success', 'Your account activated successfully');
    }
}
