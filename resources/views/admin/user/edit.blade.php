@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Users'))
@section('content_header_title', __('Edit user'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('User data') }}</h3>
                    <div class="card-tools"><a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-dark">{{ __('Back') }}</a></div>
                </div>

                {!! Form::model($user, ['route' => ['admin.user.update', $user], 'method' => 'PUT']) !!}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('name', __('Name')) !!}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        {!! Form::text('name', $user->name, ['class' => 'form-control', 'required']) !!}
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('email', __('Email')) !!}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        {!! Form::email('email', $user->email, ['class' => 'form-control', 'required']) !!}
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>    
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('role', __('List roles')) !!}
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            {!! Form::checkbox('role[]', $role->id, $user->roles->contains($role->id), ['class' => 'form-check-input', 'id' => 'role_' . $role->id]) !!}
                                            {!! Form::label('role_' . $role->id, $role->name, ['class' => 'form-check-label']) !!}
                                        </div>
                                    @endforeach
                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        {!! Form::submit(__('Save'), ['class' => 'btn btn-primary float-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop