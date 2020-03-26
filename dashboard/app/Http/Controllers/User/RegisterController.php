<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function __invoke(Request $request){
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $input = $request->all();

        $userArray = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verify_token' => Str::random(32),
        );
        $user = User::create($userArray);

        \Mail::to($user->email)->send(new VerifyEmail($user));

        session()->flash('message', 'Please check your registered email to activate your account');

        if(!is_null($user)){
            return redirect()->intended('')->with('success', 'Please check your registered email to activate your account');
        } else return back()->with('error', 'Something went wrong. Please try again');
    }
}
