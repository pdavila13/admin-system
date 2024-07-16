@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Inventory'))
@section('content_header_title', __('List inventory'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="inventoryTable" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Center') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Marca') }}</th>
                        <th>{{ __('Model') }}</th>
                        <th>{{ __('Serial Number') }}</th>
                        <th>{{ __('AET') }}</th>
                        <th>{{ __('MQ code') }}</th>
                        <th>{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataFromFacade as $item)
                        <tr>
                            <td width="12%">{{ $item->centro_def }}</td>
                            <td>{{ $item->def }}</td>
                            <td>{{ $item->marca_def }}</td>
                            <td>{{ $item->modelo_def }}</td>
                            <td>{{ $item->codigo }}</td>
                            <td>{{ !empty($item->aet) ? $item->aet : 'N/D'}}</td>
                            <td width="15%">{{ !empty($item->maquina_sap) ? $item->maquina_sap : 'N/A' }}</td>
                            <td width="10%">{{ $item->estat_integracio_descripcio }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

{{-- Push extra CSS --}}
@push('css')
    <style>
        .lightRed {
            background-color: #f0aaaa !important
        }

        .integration-state .integration-actions {
            text-align: center;
        }
        .integration td {
            vertical-align: middle;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
        }

        .dataTables_wrapper .dt-buttons {
            float: left;
            
        }
    </style>
@endpush

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(document).ready(function() {
            $('#inventoryTable').DataTable( {
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'pdf', 'print', 'colvis'],
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                columnDefs: [{
                    targets: 7,
                    render: function(data, type, full, meta) {
                        if (type === 'display' && data == 'Baixa') {
                            var rowIndex = meta.row+1;
                            $('#inventoryTable tbody tr:nth-child('+rowIndex+')').addClass('lightRed');
                            return data;
                        } else {
                            return data;
                        }
                    }
                }],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/ca.json'
                },
            });
        });
    </script>
@endpush