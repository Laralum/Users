@extends('laralum::layouts.master')
@section('icon', 'mdi-pencil-circle')
@section('title', 'Edit user')
@section('subtitle', "You're editing user #" . $user->id . " created " . $user->created_at->diffForHumans())
@section('content')
    @include('laralum_users::form', ['action' => route('laralum::users.update', ['user' => $user]), 'button' => 'Edit', 'method' => 'PATCH', 'user' => $user, 'cancel' => route('laralum::users.index')])
@endsection
