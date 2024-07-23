@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Permission'))
@section('content_header_title', __('Edit permission'))

{{-- Content body: main page content --}}
@section('content_body')
    <!-- Default box -->
    <div class="d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card card-info">
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
                            <div class="col-lg-6">
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

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="description" class="form-label">{{__('Description') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="description" id="description"
                                            required="" value="{{ $data->description }}">
                                        @error('description')
                                            <span>{{ $message }}</span>
                                        @enderror
                                        <div class="invalid-feedback">{{ __('Permission description field is required.') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer float-end float-right">
                        <button type="submit" id="submit"
                            class="btn btn-info float-end float-right">{{ __('Save changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card -->
@stop
