<?php

namespace Laralum\Users\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laralum\Users\Models\User;
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
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('laralum::users.index')->with('success', 'User with mail '. $request->input('email'). 'has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('laralum_users::edit', ['user' => User::findOrFail($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->doValidation($request, false);
        $update = [
            'name' => $request->input('name'),
        ];
        if (strlen($request->input('password')) > 0) {
            $this->doValidation($request, true);
            $update['password'] = bcrypt($request->input('password'));
        }
        $user = User::findOrFail($id);
        $user->update($update);
        return redirect()->route('laralum::users.index');
    }

    /**
     * Displays a view to confirm delete.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete($id)
    {
        if ($id == Auth::id()) {
            return redirect()->route('laralum::users.index')->with('error', 'You cannot delete yourself');
        }
        $user = User::findOrFail($id);

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
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('laralum::users.index')->with('success','User deleted!');
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
