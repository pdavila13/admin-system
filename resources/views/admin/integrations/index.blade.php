@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Integrations'))
@section('content_header')
    @can('admin.integration.create')
        <a href="{{ route('admin.integration.create') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i></a>
    @endcan
    <h1 class="text-muted">{{ __('List integrations') }}</h1>
@stop

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">        
        <div class="card-body">
            <table class="table table-striped" id="integrationTable" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Tipus Aparell') }}</th>
                        <th>{{ __('Centre') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Modality') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataFromFacadeElement as $elemento)
                        <tr>
                            <td>{{ $elemento->id }}</td>
                            <td>{{ $elemento->tipus_aparell_def }}</td>
                            <td>{{ $elemento->centro_def }}</td>
                            <td>{{ $elemento->def}}</td>
                            <td>{{ $elemento->modality }}</td>
                            <td>{{ $elemento->fecha }}</td>
                            <td class="integration-state" >
                                @if ($elemento->estat_integracio_id == '1')
                                    <span class="badge badge-success">{{ __('Evolutiu enviat') }}</span>
                                @elseif ($elemento->estat_integracio_id == '2')
                                    <span class="badge badge-secondary">{{ __('Pendent configuració') }}</span>
                                @elseif ($elemento->estat_integracio_id == '4')
                                    <span class="badge badge-primary">{{ __('En producció') }}</span>
                                @elseif ($elemento->estat_integracio_id == '3')
                                    <span class="badge badge-warning">{{ __('En proves') }}</span>
                                @elseif ($elemento->estat_integracio_id == '5')
                                    <span class="badge badge-danger">{{ __('Pendent baixa') }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="#" class="btn btn-success btn-xs"><i class="fas fa-eye"></i></a>
                                @can('admin.integration.edit')
                                    <a id="edit-button" href="{{route('admin.integration.edit', $elemento)}}" class="btn btn-info btn-xs" data-role="{{ auth()->user()->getRoleNames()->first() }}"><i class="fas fa-edit"></i></a>
                                @endcan
                            </td>
                        </tr>
                        {{-- @include('admin.integrations.modal.edit') --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

{{-- Push extra CSS --}}
@push('css')
    <style>
        .integration-state .integration-actions {
            text-align: center;
        }
        .integration td {
            vertical-align: middle;
        }
    </style>
@endpush

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(document).ready(function() {
            var selectedLanguage = 'ca';
            var dataTableConfig = {
                paging: true,
                searching: true,
                ordering: false,
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/' + selectedLanguage + '.json'
                }
            };

            $('#integrationTable').DataTable(dataTableConfig);
        });

        $('#ModalIntegrationCreate').on('shown.bs.modal', function () {
            var currentDate = moment().format('DD-MM-YYYY');
            $(this).find('.datetimepicker-input').val(currentDate);

            $(this).find('.datetimepicker').each(function() {
                $(this).datetimepicker({
                    dropdownParent: $(this).closest('.modal'),
                    format: 'DD-MM-YYYY',
                    defaultDate: new Date(),
                });
            });

            $(this).find('.select2').select2({
                theme: 'bootstrap4',
            });

            $(this).find('#marca').change(function() {
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

            $(this).find('#zona').change(function() {
                var zona = $(this).val();

                if (zona) {
                    $.ajax({
                        url: '{{ route("admin.get.centers", ":zona") }}'.replace(':zona', zona),
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


            $(this).find('#centro').change(function() {
                var centroId = $(this).val();
                if (centroId) {
                    $.ajax({
                        url: '{{ route("admin.get.plantas", ":centroId") }}'.replace(':centroId', centroId),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#planta').empty().append('<option value="" selected></option>');
                            if (data.length > 0) {
                                $.each(data, function(key, planta) {
                                    $('#planta').append('<option value="' + planta.planta + planta.edifici + '">' + planta.planta + ' ' + planta.edifici + '</option>');
                                });
                                $('#planta').prop('disabled', false);
                            } else {
                                $('#planta').prop('disabled', true);
                            }
                        }
                    });
                } else {
                    $('#planta').empty().append('<option value="" selected></option>').prop('disabled', true);
                }
            });
        });
    </script>
@endpush