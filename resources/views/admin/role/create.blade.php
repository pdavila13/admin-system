@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Roles'))
@section('content_header_title', __('Create role'))

{{-- Content body: main page content --}}
@section('content_body')
    <!-- Default box -->
    <div class="d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{__('Creare new role') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.role.index') }}"
                            class="btn btn-sm btn-dark">{{__('Back') }}</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'admin.role.store', 'method' => 'POST', 'class' => 'needs-valitation']) !!}
                    <div class="card-body">
                        @include('admin.role.partials.form')
                        {{-- <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{ Form::label('name', __('Name')) }}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {!! Form::label('permission', __('List permissions')) !!}
                                    @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            {!! Form::checkbox('permission[]', $permission->id, null, ['class' => 'form-check-input', 'id' => 'permission_' . $permission->id]) !!}
                                            {!! Form::label('permission_' . $permission->id, $permission->description, ['class' => 'form-check-label']) !!}
                                        </div>
                                    @endforeach
                                    @error('permission')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer float-end float-right">
                        {!! Form::submit(__('Save'), ['class' => 'btn btn-primary float-end float-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.card -->
@stop