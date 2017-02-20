<div class="uk-container uk-container-large">
    <div uk-grid>
        <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
        <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
            <div class="uk-card uk-card-default">
                <div class="uk-card-header">
                    {{ $title }}
                </div>
                <div class="uk-card-body">
                    <form method="POST" action="{{ $action }}">
                        {{ csrf_field() }}
                        @if(isset($method)) {{ method_field($method) }} @endif
                        <fieldset class="uk-fieldset">
                            <div class="uk-margin">
                                <label class="uk-form-label">@lang('laralum_users::general.name')</label>
                                <input value="{{ old('name', isset($user) ? $user->name : '') }}" name="name" class="uk-input" type="text" placeholder="@lang('laralum_users::general.name')">
                            </div>
                            @if ($button != 'Edit')
                                <div class="uk-margin">
                                    <label class="uk-form-label">@lang('laralum_users::general.email')</label>
                                    <input value="{{ old('email', isset($user) ? $user->email : '') }}" name="email" class="uk-input" type="email" placeholder="@lang('laralum_users::general.email')">
                                </div>
                            @endif

                            <div class="uk-margin">
                                <label class="uk-form-label">@lang('laralum_users::general.password')</label>
                                <input name="password" class="uk-input" type="password" placeholder="@lang('laralum_users::general.password')">
                            </div>

                            <div class="uk-margin">
                                <label class="uk-form-label">@lang('laralum_users::general.password_confirmation')</label>
                                <input name="password_confirmation" class="uk-input" type="password" placeholder="@lang('laralum_users::general.password_confirmation')">
                            </div>
                            <div class="uk-margin">
                                <a href="{{ $cancel }}" class="uk-align-left uk-button uk-button-default">@lang('laralum_users::general.cancel')</a>
                                <button type="submit" class="uk-button uk-button-primary uk-align-right">
                                    <span class="ion-forward"></span>&nbsp; {{ $button }}
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
