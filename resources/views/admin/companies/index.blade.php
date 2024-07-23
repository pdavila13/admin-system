@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Companies'))
@section('content_header_title', __('List companies'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">                
                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalCompanyCreate">{{ __('New') }}</a>
            </div>
            @include('admin.companies.modal.create')
        </div>
        <div class="card-body">
            <table class="table table-striped" id="companyTable" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('CIF') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->cif }}</td>
                            <td width="60%">{{ $company->description }}</td>
                            <td class="company-actions text-right">
                                <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ModalCompanyEdit{{ $company->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalCompanyDelete{{ $company->id }}">
                                    <i class="fas fa-ban"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Incluir modal de edición para cada empresa -->
    @foreach ($data as $company)
        @include('admin.companies.modal.edit', ['company' => $company])
        @include('admin.companies.modal.delete')
    @endforeach
@stop

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(function() {
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

            $('#companyTable').DataTable(dataTableConfig);
        });
    </script>
@endpush