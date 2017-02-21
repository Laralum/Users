@extends('laralum::layouts.master')
@section('icon', 'ion-person-add')
@section('title', __('laralum_users::general.create_user'))
@section('subtitle', __('laralum_users::general.create_user_desc'))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('laralum::index') }}">@lang('laralum_users::general.home')</a></li>
        <li><a href="{{ route('laralum::users.index') }}">@lang('laralum_users::general.user_list')</a></li>
        <li><span>@lang('laralum_users::general.create_user')</span></li>
    </ul>
@endsection
@section('content')
    @include('laralum_users::form', [
        'title' =>  __('laralum_users::general.create_user'),
        'action' => route('laralum::users.store'),
        'button' => __('laralum_users::general.create'),
        'cancel' => route('laralum::users.index')
    ])
@endsection
