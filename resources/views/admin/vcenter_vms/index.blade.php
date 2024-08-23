@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('vCenter Virtual Machines'))
@section('content_header')
<button id="clearUpgradeStatus" class="btn btn-sm btn-danger mb-3 float-right">Clear Upgrade Status</button>
<h1 class="text-muted">{{ __('Virtual Machines') }}</h1>
@stop

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if(!empty($vms))
                
                <table class="table table-striped table-sm vms" id="vmsTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Guest OS</th>
                            <th>Hardware Version</th>
                            <th>Tools Version</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                </table>
            @else
                <p>No se encontraron VMs.</p>
            @endif
        </div>
    </div>
@stop

{{-- Push extra CSS --}}
@push('css')
    <style>
        .lightRed {
            background-color: #f0aaaa !important
        }

        .lightGreen {
            background-color: #C6EFCE !important
        }

        .lightYellow {
            background-color: #FFEB9C !important
        }

        .vms td {
            vertical-align: middle;
        }
    </style>
@endpush

{{-- Enable Datatables Plugin --}}
@section('plugins.Datatables', true)

{{-- Push extra scripts --}}
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jeditable.js/2.0.19/jquery.jeditable.min.js"></script>
    <script>
        $(document).ready(function() {
            var dataTableConfig = {
            paging: true,
            searching: true,
            ordering: true,
            responsive: true,
            autoWidth: false,
            lengthMenu: [
                    [20, 35, 50, -1],
                    [20, 35, 50, 'All']
                ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/ca.json'
            },
            ajax: "{{ route('admin.datatable.vms') }}",
            columns: [
                { data: 'name', render: function(data, type, row) {
                    if (type === 'display') {
                        let badge = '';
                        // Verifica si 'annotation' tiene el valor 'enabled'
                        if (row.annotation === 'enabled') {
                            badge = '<span class="badge badge-info">Email Notification</span>';
                        }
                        // Retorna el nombre del servidor y el badge si corresponde
                        return data + ' ' + badge;
                    }
                    return data;
                }},
                { data: 'description' },
                { data: 'guest_OS' },
                { data: 'tools_version_status' },
                { data: 'hardware_version' },
                { data: 'upgrade_status', render: function(data, type, row) {
                    if (type === 'display') {
                        return '<select class="form-control vm-state" data-id="'+row.id+'">' +
                                '<option value=""' + (data === '' ? ' selected' : '') + '></option>' +
                                '<option value="YES"' + (data === 'YES' ? ' selected' : '') + '>YES</option>' +
                                '<option value="NO"' + (data === 'NO' ? ' selected' : '') + '>NO</option>' +
                                '<option value="REBOOT"' + (data === 'REBOOT' ? ' selected' : '') + '>REBOOT</option>' +
                            '</select>';
                    }
                    return data;
                }}
            ],
            rowCallback: function(row, data) {
                // Aplica el color de fondo a las filas según el estado de upgrade_status
                if (data.upgrade_status === 'YES') {
                    $(row).addClass('lightGreen');
                } else if (data.upgrade_status === 'NO') {
                    $(row).addClass('lightRed');
                } else if (data.upgrade_status === 'REBOOT') {
                    $(row).addClass('lightYellow');
                } else {
                    $(row).addClass('lightBlue');
                }
            }
        };
            var table = $('#vmsTable').DataTable(dataTableConfig);

            $('#vmsTable').on('change', '.vm-state', function() {
                var vmId = $(this).data('id');
                var state = $(this).val();
                var $row = $(this).closest('tr'); // Obtiene la fila correspondiente

                $.ajax({
                    url: '{{ route('admin.update') }}',
                    method: 'POST',
                    data: {
                        id: vmId,
                        column: 'upgrade_status',
                        value: state,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Actualiza solo la fila correspondiente en la tabla
                            var table = $('#vmsTable').DataTable();
                            var rowIndex = table.row($row).index(); // Obtiene el índice de la fila

                            // Supongamos que 'updated_vm' contiene los nuevos datos de la VM en el response
                            var updatedVm = response.updated_vm;

                            // Actualiza los datos de la fila con los nuevos valores
                            table.row(rowIndex).data({
                                name: updatedVm.name,
                                description: updatedVm.description,
                                guest_OS: updatedVm.guest_OS,
                                tools_version_status: updatedVm.tools_version_status,
                                hardware_version: updatedVm.hardware_version,
                                upgrade_status: updatedVm.upgrade_status
                            }).draw(false); // Redibuja la fila sin recargar toda la tabla

                            // Elimina las clases de color anteriores
                            $row.removeClass('lightRed lightGreen lightYellow');

                            // Añade la clase CSS correspondiente según el estado
                            if (updatedVm.upgrade_status === 'YES') {
                                $row.addClass('lightGreen');
                            } else if (updatedVm.upgrade_status === 'NO') {
                                $row.addClass('lightRed');
                            } else if (updatedVm.upgrade_status === 'REBOOT') {
                                $row.addClass('lightYellow');
                            } else {
                                $row.addClass('lightBlue');
                            }
                        } else {
                            alert('Failed to update VM state.');
                        }
                    },
                    error: function() {
                        alert('Error updating VM state.');
                    }
                });
            });

            $('#clearUpgradeStatus').click(function() {
                if (confirm('Are you sure you want to clear the upgrade status for all VMs except those with status "NO"?')) {
                    $.ajax({
                        url: '{{ route('admin.clearUpgradeStatus') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#vmsTable').DataTable().ajax.reload(); // Recarga la tabla después de la actualización
                            } else {
                                alert('Failed to clear upgrade status.');
                            }
                        },
                        error: function() {
                            alert('Error clearing upgrade status.');
                        }
                    });
                }
            });
        });
    </script>
@endpush