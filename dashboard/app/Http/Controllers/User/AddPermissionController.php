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

class AddPermissionController extends Controller
{
    //
    public function __invoke(Request $request, $id){
            $authUser = Auth::user();
            if($authUser->can('manage')||$authUser->hasRole('manager')){
                $user = User::findOrFail($id);
                if($request->has('view')) {
                    if($user->permissions()->where('slug', 'view')->first()==null)
                    {
                        $viewP = Permission::where('slug', 'view')->first();
                        $user->permissions()->attach($viewP);
                    }
                }
                if($request->has('edit')) {
                    if($user->permissions()->where('slug', 'edit')->first()==null)
                    {
                        $editP = Permission::where('slug', 'edit')->first();
                        $user->permissions()->attach($editP);
                    }
                }
                if($request->has('delete')) {
                    if($user->permissions()->where('slug', 'delete')->first()==null)
                    {
                        $deleteP = Permission::where('slug', 'delete')->first();
                        $user->permissions()->attach($deleteP);
                    }
                }
                if($request->has('manage')) {
                    if($user->permissions()->where('slug', 'manage')->first()==null)
                    {
                        $manageP = Permission::where('slug', 'manage')->first();
                        $user->permissions()->attach($manageP);
                    } 
                    
                }
                
                return redirect::intended('/user/user-list')->with('success', 'Permission updated successfully');
            } else return redirect::intended('')->with('error', 'You dont have permission to manage users previledge');
    }

}