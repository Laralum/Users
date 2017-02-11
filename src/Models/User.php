<?php

namespace Laralum\Users\Models;

use App\User as ExtendUser;
use File;

class User extends ExtendUser
{
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
