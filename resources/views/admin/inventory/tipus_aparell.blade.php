@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Inventory'))
@section('content_header_title', __('Equipment type'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">                
                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalEquipmentTypeCreate">{{ __('New') }}</a>
            </div>
            @include('admin.inventory.modal.create-equipment')
        </div>
        <div class="card-body">
            <table class="table table-striped" id="equipmentTypeTable">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th class="text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $equipment_type)
                        <tr>
                            <td width="5%">{{ $equipment_type->idtipus_aparell }}</td>
                            <td>{{ $equipment_type->descripcio }}</td>
                            <td class="text-right">
                                <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ModalEquipmentTypeEdit{{ $equipment_type->idtipus_aparell }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($data as $equipment_type)
        @include('admin.inventory.modal.edit-equipment', ['equipment_type' => $equipment_type])
    @endforeach

@stop

{{-- Enable Plugins --}}
@section('plugins.Datatables', true)

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(document).ready(function() {

            var dataTableConfig = {
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                autoWidth: false,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/ca.json'
                }
            };

            $('#equipmentTypeTable').DataTable(dataTableConfig);
        });
    </script>
@endpush