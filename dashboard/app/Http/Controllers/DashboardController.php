<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{
    public function __invoke(){
        return view('dashboard');
    }

}
