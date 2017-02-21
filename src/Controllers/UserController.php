<?php

namespace Laralum\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laralum\Users\Models\User;
use Laralum\Roles\Models\Role;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laralum_users::index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laralum_users::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->doValidation($request);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('laralum::users.index')->with('success', __('laralum_users::general.user_created', ['email' => $request->email]));
    }

    /**
     * Display the specified resource.
     * Currently not used
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->route('laralum::users.index')->with('error', trans('laralum_users::general.edit_yourself_error'));
        }
        return view('laralum_users::edit', ['user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->route('laralum::users.index')->with('error', trans('laralum_users::general.edit_yourself_error'));
        }
        $this->doValidation($request, false);
        $update = [
            'name' => $request->name,
        ];
        if ($request->password) {
            $this->doValidation($request, true);
            $update['password'] = bcrypt($request->password);
        }
        $user->update($update);
        return redirect()->route('laralum::users.index');
    }

    /**
     * Displays a view to confirm delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete(User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->route('laralum::users.index')->with('error', trans('laralum_users::general.delete_yourself_error'));
        }

        return view('laralum::pages.confirmation', [
            'method' => 'DELETE',
            'action' => route('laralum::users.destroy', ['user' => $user]),
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == Auth::id()) {
            return redirect()->route('laralum::users.index')->with('error', trans('laralum_users::general.delete_yourself_error'));
        }

        $user->delete();
        return redirect()->route('laralum::users.index')->with('success', __('laralum_users::general.user_deleted', ['id' => $user->id]));
    }

    /**
     * Manage roles from users.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manageRoles(User $user)
    {
        $roles = Role::all();

        return view('laralum_users::roles', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRoles(Request $request, User $user)
    {
        $roles = Role::all();

        foreach($roles as $role) {
            if( array_key_exists($role->id, $request->all()) ) {
                $role->addUser($user);
            } else {
                $role->deleteUser($user);
            }
        }
        return redirect()->route('laralum::users.index')->with('success', __('laralum_users::general.user_roles_updated', ['id' => $user->id]));
    }


    private function doValidation($request, $requiredPass = true)
    {
        $rules = '';
        if ($requiredPass) {
            $rules = 'required|min:6|confirmed';
        }
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'sometimes|required|email|unique:users',
            'password' => $rules,
        ]);
    }
}
