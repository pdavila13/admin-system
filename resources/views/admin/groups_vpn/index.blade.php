@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('VPN Groups'))
@section('content_header_title', __('VPN Groups List'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalGroupVPNCreate">{{ __('New') }}</a>
            </div>

            @include('admin.groups_vpn.modal.create')
        </div>
        <div class="card-body">
            <table class="table table-striped" id="group_vpnTable" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Network') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $group_vpn)
                        <tr>
                            <td>{{ $group_vpn->company->name}}</td>
                            <td><a href="{{ env('GROUP_VPN_URL') . $group_vpn->name }}" target="_blank">{{ $group_vpn->name }}</a></td>
                            <td>{{ $group_vpn->network }}</td>
                            <td>{{ $group_vpn->description }}</td>
                            <td class="group_vpn-actions text-right">
                                <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ModalGroupVPNEdit{{ $group_vpn->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalGroupVPNDelete{{ $group_vpn->id }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($data as $group_vpn)
        @include('admin.groups_vpn.modal.edit', ['group_vpn' => $group_vpn])
        @include('admin.groups_vpn.modal.delete')
    @endforeach
@stop

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(document).ready(function() {
            var selectedLanguage = 'ca';
            var dataTableConfig = {
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/' + selectedLanguage + '.json'
                }
            };

            $('#group_vpnTable').DataTable(dataTableConfig);

            $('.modal').on('shown.bs.modal', function () {
                $(this).find('.select2').select2({
                    theme: 'bootstrap4',
                });
            });
        });
    </script>
@endpush