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
use Illuminate\Support\Facades\Cache;

class AddRoleController extends Controller
{
    //
    public function __invoke(Request $request, $id){
            $authUser = Auth::user();
            if($authUser->can('manage')||$authUser->hasRole('manager')){
                $user = User::findOrFail($id);
                if($request->has('editor')) {
                    if($user->roles()->where('slug', 'editor')->first()==null)
                    {
                        $editorR = Role::where('slug', 'editor')->first();
                        $user->roles()->attach($editorR);
                    }
                }
                if($request->has('deleter')) {
                    if($user->roles()->where('slug', 'deleter')->first()==null)
                    {
                        $deleterR = Role::where('slug', 'deleter')->first();
                        $user->roles()->attach($deleterR);
                    }
                }
                Cache::flush();
                return redirect::intended('user/user-list')->with('success', 'Permission updated successfully');
            } else return redirect::intended('/admin')->with('error', 'You dont have permission to manage users previledge');
    }

}