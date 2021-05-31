@extends('admin.layouts.app')
@if (!empty($user))
    @section('title','Edit User')
@else
    @section('title','Add User')
@endif
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">@yield('title')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($user))
                                {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
                            @else
                                {!! Form::open(['route' => ['users.store']]) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                @if (!empty($user))
                                    {!! Form::email('email', null, ['readonly' => 'readonly', 'class' => 'form-control', 'placeholder' => "Email"]) !!}
                                @else
                                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => "Email"]) !!}
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Name"]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('role_id', 'Role') !!}
                                {!! Form::select('role_id', $roles, !empty($user) ? $user->role_id : null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                        <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection