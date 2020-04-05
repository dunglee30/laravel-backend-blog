<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    public function __invoke(Request $request){
        // 
        if(Auth::check()) return redirect()->intended('');
        $request->validate([
            "email" => 'required|email',
            "password" => 'required|min:8',
        ]);

        $credential = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if($user->email_verified == 1){
            if(Auth::attempt($credential)){
                return redirect()->intended('/admin');
            } 
        }
        return back()->with('error', 'Email or password are invalid');
    }
}
