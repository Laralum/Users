<?php

namespace Laralum\Users\Policies;

use Laralum\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Filters the authoritzation.
     *
     * @param mixed $user
     * @param mixed $ability
     */
    public function before($user, $ability)
    {
        if (User::findOrFail($user->id)->superAdmin()) {
            return true;
        }
    }

    /**
     * Determine if the current user can view users module.
     *
     * @param  mixed $user
     * @return bool
     */
    public function access($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::users.access');
    }

    /**
     * Determine if the current user can view users.
     *
     * @param  mixed $user
     * @return bool
     */
    public function view($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::users.view');
    }

    /**
     * Determine if the current user can create users.
     *
     * @param  mixed  $user
     * @return bool
     */
    public function create($user)
    {
        return User::findOrFail($user->id)->hasPermission('laralum::users.create');
    }

    /**
     * Determine if the current user can update users.
     *
     * @param  mixed $user
     * @return bool
     */
    public function update($user, User $userToManage)
    {
        $user = User::findOrFail($user);
        if ($userToManage->id == $user->id || $userToManage->superAdmin()) {
            return false;
        }
        return User::findOrFail($user->id)->hasPermission('laralum::users.update');
    }


    /**
     * Determine if the current user can update users.
     *
     * @param  mixed $user
     * @return bool
     */
    public function roles($user, User $userToManage)
    {
        $user = User::findOrFail($user);
        if ($userToManage->id == $user->id) {
            return false;
        }
        return User::findOrFail($user->id)->hasPermission('laralum::users.roles');
    }

    /**
     * Determine if the current user can delete users.
     *
     * @param  mixed $user
     * @return bool
     */
    public function delete($user, User $userToManage)
    {
        $user = User::findOrFail($user);
        if ($userToManage->id == $user->id || $userToManage->superAdmin()) {
            return false;
        }
        return $user->hasPermission('laralum::users.delete');
    }

}
