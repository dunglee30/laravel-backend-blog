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
use Artisan;

class LogoutController extends Controller
{
    //
    public function __invoke(Request $request ) {
        Artisan::call('cache:clear');
        $request->session()->flush();
        Auth::logout();
        return redirect::intended('');
    }
}
