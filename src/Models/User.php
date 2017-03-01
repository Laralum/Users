<?php

namespace Laralum\Users\Models;

use App\User as ExtendUser;
use Laralum\Roles\Models\Role;
use Laralum\Permissions\Models\Permission;
use Illuminate\Support\Facades\File;

use Laralum\Notifications\Traits\Notifiable;
use Laralum\Roles\Traits\HasRolesAndPermissions;

class User extends ExtendUser
{
    use Notifiable, HasRolesAndPermissions;

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
    public function avatar($size = 100)
    {
        /*
        if(File::exists(public_path('/avatars'.'/'.md5($this->email)))){
            return asset('/avatars'.'/'.md5($this->email));
        }
        return "https://tracker.moodle.org/secure/attachment/30912/f3.png";
        */
        // Get gavatar avatar
        $email = md5(strtolower(trim($this->email)));
        $default = urlencode("https://tracker.moodle.org/secure/attachment/30912/f3.png");
        return "https://www.gravatar.com/avatar/$email?d=$default&s=$size";
    }

    /**
    * Returns the a boolean for know if user has avatar.
    */
    public function hasAvatar()
    {
        /*
        if (File::exists(public_path('/avatars/'.md5($this->email)))){
            return true;
        }
        return false;
        */

        // There's always a gavatar
        return true;
    }
}
