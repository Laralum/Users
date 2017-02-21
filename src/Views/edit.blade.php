@extends('laralum::layouts.master')
@section('icon', 'ion-edit')
@section('title', __('laralum_users::general.edit_user'))
@section('subtitle', __('laralum_users::general.edit_desc', ['id' => "#".$user->id, 'time_ago' => $user->created_at->diffForHumans()]))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('laralum::index') }}">@lang('laralum_tickets::general.home')</a></li>
        <li><a href="{{ route('laralum::users.index') }}">@lang('laralum_users::general.user_list')</a></li>
        <li><span>@lang('laralum_users::general.edit_user')</span></li>
    </ul>
@endsection
@section('content')
    @include('laralum_users::form', [
        'title' =>  __('laralum_users::general.edit_user'),
        'action' => route('laralum::users.update', ['user' => $user]),
        'button' => __('laralum_users::general.edit'),
        'method' => 'PATCH',
        'cancel' => route('laralum::users.index'),
    ])
@endsection
