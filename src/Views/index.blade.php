@extends('laralum::layouts.master')
@section('icon', 'mdi-account-multiple')
@section('title', 'Users')
@section('subtitle', 'Here you can manage users')
@section('content')
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
                        <h4>Users list</h4><br />
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
                                                <a href="{{ route('laralum::users.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="{{ route('laralum::users.destroy.confirm', ['id' => $user->id]) }}" class="btn btn-danger btn-sm" @if($user->id == Auth::id()) style="pointer-events: none;opacity: 0.5;" @endif>
                                                    <i class="mdi mdi-delete"></i>
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
