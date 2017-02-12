@extends('laralum::layouts.master')
@section('icon', 'mdi-account-multiple')
@section('title', 'Users')
@section('subtitle', 'Users will allow you to easily manage all your website users and assign them roles.')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-block">
                    <h5>Quick Actions</h5><br />
                    <a class="btn btn-success" href="{{ route('laralum::users.create') }}">Create User</a>
                    <a class="btn btn-primary disabled" href="#">Users Settings</a>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col col-md-12">
            <div class="card shadow">
                <div class="card-block">
                    @if ($users->count() == 0)
                        <center>
                            <br /><br />
                            <h3>There are no users yet</h3>
                            <h1 class="mdi mdi-emoticon-sad"></h1>
                            <br />
                        </center>
                    @else
                        <h5>Users list</h5><br />
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th>{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('laralum::users.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit user #{{$user->id}}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="{{ route('laralum::users.destroy.confirm', ['id' => $user->id]) }}" class="btn btn-danger btn-sm @if($user->id == Auth::id()) disabled @endif" data-toggle="tooltip" data-placement="top" title="Delete user #{{$user->id}}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                                <a href="{{ route('laralum::users.roles.manage', ['id' => $user->id]) }}" class="btn btn-warning btn-sm @if($user->id == Auth::id()) disabled @endif" data-toggle="tooltip" data-placement="top" title="Manage roles of user #{{$user->id}}">
                                                    <i class="mdi mdi-svg"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
