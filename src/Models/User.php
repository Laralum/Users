<?php

namespace Laralum\Users\Models;

use App\User as ExtendUser;
use Laralum\Roles\Models\Role;
use Laralum\Permissions\Models\Permission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;

class User extends ExtendUser
{
    use Notifiable;

    /**
    * Returns the user roles.
    */
    public function roles()
    {
        return $this->belongsToMany('Laralum\Roles\Models\Role', 'laralum_role_user');
    }

    /**
    * Returns if the user has a permission.
    * @param mixed $permision
    * @return bool
    */
    public function hasPermission($permission)
    {
        $permission = !is_string($permission) ?: Permission::where(['slug' => $permission])->first();

        foreach( $this->roles as $role ) {
            foreach( $role->permissions as $p ) {
                if( $p->id == $permission->id ) {
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
     * Returns true if the user is a super administrator.
     */
    public function superAdmin()
    {
        return $this->id == User::first()->id;
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
