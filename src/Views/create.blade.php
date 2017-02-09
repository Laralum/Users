@extends('laralum::layouts.master')
@section('icon', 'mdi-account-plus')
@section('title', 'Create User')
@section('subtitle', 'Create a new user to the database')
@section('content')
    @include('laralum_users::form', ['action' => route('laralum::users.store'), 'button' => 'Create', 'cancel' => route('laralum::users.index')])
@endsection
