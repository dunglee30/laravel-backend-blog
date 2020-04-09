<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Permission;
use App\Role;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DeleteRoleController extends Controller
{
    //
    public function __invoke(Request $request, $slug, $id){
            $authUser=Auth::user();
            if($authUser->hasRole('manager')){
                $user = User::findOrFail($id);
                $role = Role::where('slug', $slug)->first();
                // echo $slug;
                // echo $user->name;
                $user->roles()->detach($role);
                return redirect::intended('user/user-list')->with('success', 'role update successfully');
            } else return redirect::intended('user/user-list')->with('error', 'role denied since you are not manager');
    }
}
