<?php

namespace Laralum\Users\Models;

use App\User as ExtendUser;
use Laralum\Roles\Models\Role;
use Laralum\Permisions\Models\Permision;
use File;

class User extends ExtendUser
{
    /**
    * Returns the user roles.
    */
    public function roles()
    {
        return $this->belongsToMany('Laralum\Roles\Models\Role');
    }

    /**
    * Returns if the user has a permission.
    * @param mixed $permision
    * @return bool
    */
    public function hasPermissions($permision)
    {
        $permission = !is_string($permission) ?: Permission::where(['slug' => $permission])->firstOrFail();

        foreach( $this->roles as $role ) {
            foreach( $role->permissions as $p ) {
                if( $p->id == $permision->id ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
    * Returns if the user has a role.
    * @param mixed $role
    * @return bool
    */
    public function hasRole(Role $role)
    {
        $role = !is_string($role) ?: Role::where(['name' => $role])->firstOrFail();

        foreach( $this->roles as $r ) {
            if( $r->id == $role->id ) {
                return true;
            }
        }

        return false;
    }

    /**
    * Returns the user avatar.
    */
    public function avatar()
    {
        if(File::exists(public_path('/avatars'.'/'.md5($this->email)))){
            return asset('/avatars'.'/'.md5($this->email));
        }
        return "https://tracker.moodle.org/secure/attachment/30912/f3.png";
    }

    /**
    * Returns the a boolean for know if user has avatar.
    */
    public function hasAvatar()
    {
        if(File::exists(public_path('/avatars/'.md5($this->email)))){
            return true;
        }
        return false;
    }
}
