<div class="row">
    <div class="col-md-12 col-lg-6 offset-lg-3">
        <div class="card shadow">
            <div class="card-block">
                <form action="{{$action}}" method="POST">
                    {!! csrf_field() !!}
                    @if(isset($method)) {{ method_field($method) }} @endif
                    @php
                        $fields = ['name' => 'text', 'email' => 'email', 'password' => 'password', 'password_confirmation' => 'password'];
                        if ($button == 'Edit') {
                            unset($fields['email']);
                        }
                    @endphp
                    @foreach ($fields as $field => $type)
                        <div class="form-group">
                            <label for="{{ $field }}">{{ str_replace('_', ' ', ucfirst($field)) }}</label>
                            <input type="{{ $type }}" name="{{ $field }}" value="@if($type != 'password'){{ old($field, isset($user->$field) ? $user->$field : '' ) }}@endif" class="form-control" id="{{ $field }}">
                            <strong class="text-danger">{{ $errors->first($field) }}</strong>
                        </div>
                    @endforeach
                    <a href="{{$cancel}}" class="btn btn-warning float-left">Cancel</a>
                    <button type="submit" class="btn btn-success float-right clickable">{{ $button }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
