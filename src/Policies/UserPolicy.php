<?php

namespace Laralum\Users\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Laralum\Users\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the current user can view users module.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function access($user)
    {
        if (User::findOrFail($user->id)->superAdmin()) {
            return true;
        }

        return User::findOrFail($user->id)->hasPermission('laralum::users.access');
    }

    /**
     * Determine if the current user can view users.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function view($user)
    {
        if (User::findOrFail($user->id)->superAdmin()) {
            return true;
        }

        return User::findOrFail($user->id)->hasPermission('laralum::users.view');
    }

    /**
     * Determine if the current user can create users.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function create($user)
    {
        if (User::findOrFail($user->id)->superAdmin()) {
            return true;
        }

        return User::findOrFail($user->id)->hasPermission('laralum::users.create');
    }

    /**
     * Determine if the current user can update users.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function update($user, User $userToManage)
    {
        if ($userToManage->id == $user->id || $userToManage->superAdmin()) {
            return false;
        }

        if (User::findOrFail($user->id)->superAdmin()) {
            return true;
        }

        return User::findOrFail($user->id)->hasPermission('laralum::users.update');
    }

    /**
     * Determine if the current user can update users.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function roles($user, User $userToManage)
    {
        if (User::findOrFail($user->id)->superAdmin()) {
            return true;
        }

        if ($userToManage->id == $user->id || $userToManage->superAdmin()) {
            return false;
        }

        return User::findOrFail($user->id)->hasPermission('laralum::users.roles');
    }

    /**
     * Determine if the current user can delete users.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function delete($user, User $userToManage)
    {
        if ($userToManage->id == $user->id || $userToManage->superAdmin()) {
            return false;
        }

        return User::findOrFail($user)->hasPermission('laralum::users.delete');
    }
}
