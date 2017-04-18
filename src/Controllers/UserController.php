<?php

namespace Laralum\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laralum\Roles\Models\Role;
use Laralum\Users\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', User::class);

        return view('laralum_users::index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('laralum_users::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $this->validate($request, [
            'name'     => 'required|max:255',
            'email'    => 'sometimes|required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create($request->all());

        return redirect()->route('laralum::users.index')->with('success', __('laralum_users::general.user_created', ['email' => $request->email]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Laralum\Users\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('laralum_users::edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request   $request
     * @param \Laralum\Users\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name'     => 'required|max:255',
        ]);

        $user->update([
            'name' => $request->name
        ]);

        return redirect()->route('laralum::users.index');
    }

    /**
     * Displays a view to confirm delete.
     *
     * @param \Laralum\Users\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete(User $user)
    {
        $this->authorize('delete', $user);

        return view('laralum::pages.confirmation', [
            'method' => 'DELETE',
            'action' => route('laralum::users.destroy', ['user' => $user]),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Laralum\Users\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        File::delete(public_path('/avatars/'.md5($user->email)));

        return redirect()->route('laralum::users.index')->with('success', __('laralum_users::general.user_deleted', ['id' => $user->id]));
    }

    /**
     * Manage roles from users.
     *
     * @param \Laralum\Users\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function manageRoles(User $user)
    {
        $this->authorize('roles', $user);

        $roles = Role::all();

        return view('laralum_users::roles', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request   $request
     * @param \Laralum\Users\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRoles(Request $request, User $user)
    {
        $this->authorize('roles', $user);

        $roles = Role::all();

        foreach ($roles as $role) {
            if (array_key_exists($role->id, $request->all())) {
                $role->addUser($user);
            } else {
                $role->deleteUser($user);
            }
        }

        return redirect()->route('laralum::users.index')->with('success', __('laralum_users::general.user_roles_updated', ['id' => $user->id]));
    }
}
