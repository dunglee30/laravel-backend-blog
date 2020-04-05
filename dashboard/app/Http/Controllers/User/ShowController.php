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

class ShowController extends Controller
{
    //
    public function showRegister(){
        if(Auth::check()) return redirect()->intended('');
        return view('auth.register');
    }

    public function showLogin(){
        if(Auth::check()) return redirect()->intended('');
        return view('auth.login');
    }

    public function showList(){
            $users = User::all();
            return view('list.user-list')->with('users', $users);
    }

    public function showPermissionPage($id){
            $authUser = Auth::user();
            if($authUser->can('manage')){
                $user = User::findOrFail($id);
                $permissions = $user->permissions;
                return view('list.user-permission', ['user'=>$user, 'permissions'=>$permissions]);
            } else return redirect::intended('/admin')->with('error', 'You dont have permission to manage users previledge');
    }
    
}
