@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Integrations'))
@section('content_header_title', __('Create new element'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Integration data') }}</h3>
                    <div class="card-tools">                
                        <a href="{{route('admin.integration.index')}}" class="btn btn-sm btn-dark">{{ __('Back') }}</a>
                    </div>
                </div>

                {!! Form::open(['route' => 'admin.integration.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="card-body">
                    <div class="container-fluid">
                        @include('admin.integrations.partials.form-electro')
                    </div>
                </div>

                    <div class="card-footer">
                        <button type="submit" id="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

{{-- Enable Plugins --}}
@section('plugins.Select2', true)

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            $('#marca').change(function() {
                var marcaID = $(this).val();
                if (marcaID) {
                    $.ajax({
                        url: '{{ route("admin.get.models", ":marcaID") }}'.replace(':marcaID', marcaID),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#modelo').empty().append('<option value="" selected></option>');
                            $.each(data, function(key, value) {
                                $('#modelo').append('<option value="'+ value.id +'">'+ value.def +'</option>');
                            });
                        }
                    });
                } else {
                    $('#modelo').empty().append('<option value="" selected></option>');
                }
            });

            $('#area').change(function() {
                var area = $(this).val();
                
                if (area) {
                    $.ajax({
                        url: '{{ route("admin.get.centers", ":area") }}'.replace(':area', area),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#centro').empty().append('<option value="" selected></option>');
                            $.each(data, function(key, value) {
                                $('#centro').append('<option value="'+ value.id +'">'+ value.def +'</option>');
                            });
                        }
                    });
                } else {
                    $('#centro').empty().append('<option value="" selected></option>');
                }
            });

            $('#centro').change(function() {
                var centroId = $(this).val();
                if (centroId) {
                    $.ajax({
                        url: '{{ route("admin.get.plantas", ":centroId") }}'.replace(':centroId', centroId),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#ubicacio').empty().append('<option value="" selected></option>');
                            if (data.length > 0) {
                                $.each(data, function(key, planta) {
                                    $('#ubicacio').append('<option value="' + planta.planta + planta.edifici + '">' + planta.planta + ' ' + planta.edifici + '</option>');
                                });
                                $('#ubicacio').prop('disabled', false);
                            } else {
                                $('#ubicacio').prop('disabled', true);
                            }
                        }
                    });
                } else {
                    $('#ubicacio').empty().append('<option value="" selected></option>').prop('disabled', true);
                }
            });
        });
    </script>
@endpush