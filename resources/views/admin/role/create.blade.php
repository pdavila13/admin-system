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
                <form action="{{ route('admin.role.store') }}" method="POST"
                    class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{__('Name') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="name" id="name"
                                            required="" value="{{ old('name') }}">
                                            @error('name')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        <div class="invalid-feedback">{{ __('Role name field is required.') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer float-end float-right">
                        <button type="submit" id="submit"
                            class="btn btn-primary float-end float-right">{{__('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card -->
@stop