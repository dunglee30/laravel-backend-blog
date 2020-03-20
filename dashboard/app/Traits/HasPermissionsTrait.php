<?php
namespace App\Traits;

use App\Permission;
use App\Role;

trait HasPermissionsTrait {

    /** 
    * check role existed
    * @param mixed... roles
    * @return bool
    */

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }


    public function roles() {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function hasRole(... $roles) {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)){
                return true;
            }
        }
        return false;
    }

    /**
    * @param $permission
    * @return bool
    */
    protected function hasPermission($permission) {
        return (bool) $this->permissions()->where('slug', $permission->slug)->count();
    }

    public function hasPermissionTo($permission) {
        return $this->hasPermission($permission);
    }

    /**
        * @param array $permissions
        * @return mixed
    */

    protected function getAllPermissions(array $permissions) {
        return Permission::whereIn('slug', $permissions)->get();
    }

    /**
        * @param mixed ...$permissions
        * @return $this
    */

    public function givePermissionsTo(... $permissions) {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null) return $this;
        $this->permissions()->saveMany($permissions);
        return $this;
    }
    
    public function deletePermissions(... $permissions) {
        $permissons = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions($permissions) {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }
} 
?>