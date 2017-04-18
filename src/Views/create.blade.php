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
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
            <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('laralum_users::general.create_user')
                    </div>
                    <div class="uk-card-body">
                        <form method="POST" action="{{ route('laralum::users.store') }}" class="uk-form-stacked">
                            {{ csrf_field() }}
                            <fieldset class="uk-fieldset">
                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_users::general.name')</label>
                                    <input value="{{ old('name') }}" name="name" class="uk-input" type="text" placeholder="@lang('laralum_users::general.name')">
                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_users::general.email')</label>
                                    <input value="{{ old('email') }}" name="email" class="uk-input" type="email" placeholder="@lang('laralum_users::general.email')">
                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_users::general.password')</label>
                                    <input name="password" class="uk-input" type="password" placeholder="@lang('laralum_users::general.password')">
                                </div>

                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_users::general.password_confirmation')</label>
                                    <input name="password_confirmation" class="uk-input" type="password" placeholder="@lang('laralum_users::general.password_confirmation')">
                                </div>
                                <div class="uk-margin">
                                    <a href="{{ route('laralum::users.index') }}" class="uk-align-left uk-button uk-button-default">@lang('laralum_users::general.cancel')</a>
                                    <button type="submit" class="uk-button uk-button-primary uk-align-right">
                                        <span class="ion-forward"></span>&nbsp; @lang('laralum_users::general.create')
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
        </div>
    </div>
@endsection
