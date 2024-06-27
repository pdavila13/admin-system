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
                                    <span class="badge badge-primary">{{ __('High') }}</span>
                                @elseif ($elemento->estat_integracio_id == '2')
                                    <span class="badge badge-secondary">{{ __('Send to eCAP') }}</span>
                                @elseif ($elemento->estat_integracio_id == '3')
                                    <span class="badge badge-secondary">{{ __('Send to SAP') }}</span>
                                @elseif ($elemento->estat_integracio_id == '4')
                                    <span class="badge badge-info">{{ __('In tests') }}</span>
                                @elseif ($elemento->estat_integracio_id == '5')
                                    <span class="badge badge-success">{{ __('Integrated') }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="#" class="btn btn-success btn-xs"><i class="fas fa-eye"></i></a>
                                @can('admin.integration.edit')
                                    <a href="{{route('admin.integration.edit', $elemento)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
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
    </script>
@endpush