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