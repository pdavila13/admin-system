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
            <table class="table table-striped" id="integrationTable" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Tipus Aparell') }}</th>
                        <th>{{ __('Centre') }}</th>
                        {{-- <th width="15%">{{ __('Description') }}</th> --}}
                        <th>{{ __('AET') }}</th>
                        <th>{{ __('MQ code') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataFromFacadeElement as $elemento)
                        <tr>
                            <td>{{ $elemento->id }}</td>
                            <td>{{ $elemento->tipus_aparell_def }}</td>
                            <td width="15%">{{ $elemento->centro_def }}</td>
                            {{-- <td>{{ $elemento->def}}</td> --}}
                            <td>{{ $elemento->aet }}</td>
                            <td width="15%">{{ !empty($elemento->maquina_sap) ? $elemento->maquina_sap : 'N/A' }}</td>
                            <td class="integration-state" >
                                @if ($elemento->estat_integracio_id == '1')
                                    <span class="badge badge-primary">{{ __('High') }}</span>
                                @elseif ($elemento->estat_integracio_id == '2')
                                    <span class="badge badge-secondary">{{ __('Send to eCAP') }}</span>
                                @elseif ($elemento->estat_integracio_id == '3')
                                    <span class="badge badge-secondary">{{ __('Send to SAP') }}</span>
                                @elseif ($elemento->estat_integracio_id == '4')
                                    <span class="badge badge-info">{{ __('In tests') }}</span>
                                @elseif ($elemento->estat_integracio_id == '5')
                                    <span class="badge badge-success">{{ __('Integrated') }}</span>
                                @elseif ($elemento->estat_integracio_id == '6')
                                    <span class="badge badge-danger">{{ __('Discharged') }}</span>
                                @endif
                            </td>
                            <td class="integration-actions text-right">
                                <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#ModalIntegrationShow{{ $elemento->id }}"><i class="fas fa-eye"></i></a>

                                @can('admin.integration.edit')
                                    <a href="{{route('admin.integration.edit', $elemento)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                @endcan
                                
                                @can('admin.integration.delete')
                                    <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalIntegrationDelete{{ $elemento->id }}"><i class="fas fa-ban"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($dataFromFacadeElement as $elemento)
        @include('admin.integrations.modal.show', ['elemento' => $elemento])
        @include('admin.integrations.modal.delete', ['elemento' => $elemento])
    @endforeach  
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

{{-- Enable Plugins --}}
@section('plugins.Datatables', true)

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(document).ready(function() {
            var dataTableConfig = {
                paging: true,
                searching: true,
                ordering: false,
                responsive: true,
                autoWidth: false,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/ca.json'
                }
            };

            $('#integrationTable').DataTable(dataTableConfig);
        });
    </script>
@endpush