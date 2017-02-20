@extends('laralum::layouts.master')
@section('icon', 'ion-person-stalker')
@section('title', trans('laralum_users::general.users'))
@section('subtitle', trans('laralum_users::general.users_desc'))
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid class="uk-child-width-1-1">
            <div>
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('laralum_advertisements::general.advertisement_list')
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('laralum_users::general.name')</th>
                                        <th>@lang('laralum_users::general.email')</th>
                                        <th>@lang('laralum_users::general.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="uk-table-shrink">
                                                <div class="uk-button-group">
                                                    <a href="{{ route('laralum::users.roles.manage', ['id' => $user->id]) }}" class="uk-button uk-button-small uk-button-default">
                                                        @lang('laralum_users::general.roles')
                                                    </a>
                                                    <a href="{{ route('laralum::users.edit', ['id' => $user->id]) }}" class="uk-button uk-button-small uk-button-default @if($user->id == Auth::id()) uk-disabled @endif">
                                                        @lang('laralum_users::general.edit')
                                                    </a>
                                                    <a href="{{ route('laralum::users.destroy.confirm', ['user' => $user->id]) }}" class="uk-button uk-button-small uk-button-danger @if($user->id == Auth::id()) uk-disabled @endif">
                                                        @lang('laralum_users::general.delete')
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
