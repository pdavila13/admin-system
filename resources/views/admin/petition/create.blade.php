@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Petition'))
@section('content_header_title', __('Create petition'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Petition data') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.petition.index') }}" class="btn btn-info btn-sm">{{ __('Back') }}</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.petition.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @include('admin.petition.partials.form')
                        </div>
                        <div class="card-footer">
                            {{ Form::submit(__('Save'), ['class' => 'btn btn-primary float-right']) }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- Enable Plugins --}}
@section('plugins.Select2', true)
@section('plugins.TempusDominusBs4', true)

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(document).ready(function() {
            var currentDate = moment().format('DD-MM-YYYY');
            $('#datepicker').val(currentDate);

            $('.datetimepicker').datetimepicker({
                format: 'DD-MM-YYYY'
            });

            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@endpush