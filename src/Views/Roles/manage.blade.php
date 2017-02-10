@extends('laralum::layouts.master')
@section('icon', 'mdi-key-change')
@section('title', 'User Roles')
@section('subtitle', 'Editing user #' . $user->id . ' roles. Currently ' . $roles->count() . ' available roles.')
@section('content')
    <div class="row">
        <div class="col col-md-12 col-lg-8 offset-lg-2">
            <div class="card shadow">
                <div class="card-block">
                    <form method="POST">
                        {{ csrf_field() }}
                        <h5>Available Roles</h5><br />
                        <div class="row">
                            @foreach($roles as $role)
                                @php $current = 0; $max = round($roles->count() / 2); @endphp
                                @if($current == 0 or $current == $max)
                                    <div class="col-md-12 col-lg-6">
                                @endif

                                <div class="form-check">
                                    <label class="custom-control custom-checkbox">
                                        <input name="{{ $role->id }}" type="checkbox" class="custom-control-input" aria-describedby="{{ $role->id }}-desc" @if($role->hasUser($user)) checked @endif >
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">{{ $role->name }}</span>
                                    </label>
                                    <small id="{{ $role->id }}-desc" class="form-text text-muted">
                                        {{ $role->description }}
                                    </small>
                                </div>

                                @if($current == 0 or $current == $max)
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('laralum::users.index') }}" class="btn btn-warning float-left">Cancel</a>
                                <button type="submit" class="btn btn-success float-right clickable">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
