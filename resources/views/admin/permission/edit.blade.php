@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Permission'))
@section('content_header_title', __('Edit permission'))

{{-- Content body: main page content --}}
@section('content_body')
    <!-- Default box -->
    <div class="d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('admin.permission.index') }}"
                            class="btn btn-sm btn-dark">{{ __('Back') }}</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.permission.store') }}" method="POST"
                    class="needs-validation" novalidate="">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        required="" value="{{ $data->name }}">
                                        @error('name')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    <div class="invalid-feedback">{{ __('Permission name field is required.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer float-end float-right">
                        <button type="submit" id="submit"
                            class="btn btn-primary float-end float-right">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card -->
@stop
