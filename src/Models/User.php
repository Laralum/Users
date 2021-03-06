<?php

namespace Laralum\Users\Models;

use ConsoleTVs\Support\Traits\MaterialFunctions;
use ConsoleTVs\Support\Traits\Utilities;
use Illuminate\Foundation\Auth\User as ExtendUser;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Laralum\Laralum\Packages;
use Laralum\Notifications\Traits\Notifiable;
use Laralum\Roles\Traits\HasRolesAndPermissions;

class User extends ExtendUser
{
    use Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Returns true if the user is a super administrator.
     */
    public function superAdmin()
    {
        return in_array($this->email, config('laralum.superadmins'));
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

        if (Utilities::validGravatar($this->email)) {
            return Utilities::gavatar($this->email);
        }
        $color = Packages::installed('customization') ? \Laralum\Customization\Models\Customization::first()->navbar_color : '#1e87f0';

        return MaterialFunctions::materialAvatar($this->name, $size, $color);
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

    /**
     * Hash the password before saving.
     *
     * @param string $password
     *
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Return if the user have access to laralum.
     *
     * @return bool
     */
    public function laralumAccess()
    {
        return $this->hasPermission('laralum::access') || $this->superAdmin();
    }
}
