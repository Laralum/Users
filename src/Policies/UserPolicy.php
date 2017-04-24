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
        $user = User::findOrFail($user->id);

        return $user->hasPermission('laralum::users.access') || $user->superAdmin();
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
        $user = User::findOrFail($user->id);

        return $user->hasPermission('laralum::users.view') || $user->superAdmin();
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
        $user = User::findOrFail($user->id);

        return $user->hasPermission('laralum::users.create') || $user->superAdmin();
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

        $user = User::findOrFail($user->id);

        return $user->hasPermission('laralum::users.update') || $user->superAdmin();
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
        if ($userToManage->id == $user->id || $userToManage->superAdmin()) {
            return false;
        }

        $user = User::findOrFail($user->id);

        return $user->hasPermission('laralum::users.roles') || $user->superAdmin();
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

        $user = User::findOrFail($user->id);

        return $user->hasPermission('laralum::users.delete') || $user->superAdmin();
    }
}
