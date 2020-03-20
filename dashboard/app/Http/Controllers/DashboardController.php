<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{
    
    public function dashboard(){
        if(Auth::check()) return view('dashboard');
        else return redirect::intended('login')->withError('You do not have permission to access');
    }

}
