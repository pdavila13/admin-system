@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Companies'))
@section('content_header_title', __('Edit company'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Company data') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.company.index') }}" class="btn btn-info btn-sm">{{ __('Back') }}</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.company.update',$data) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ __('Company Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter company name" required value="{{ $data->name }}">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="cif">{{ __('CIF') }}</label>
                                <input type="text" class="form-control" id="cif" name="cif"
                                    placeholder="Enter company cif" required value="{{ $data->cif }}">
                            </div>
                            @error('cif')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea type="text" class="form-control" id="description" name="description"
                                    placeholder="Enter company description">{{ $data->description }}</textarea>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop