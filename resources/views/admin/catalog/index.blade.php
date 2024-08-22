@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Catàleg de fitxers'))
@section('content_header_title', __('Search the catalog'))

@section('content_body')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    @include('admin.catalog.partials.form-search-files')
                </div>

                @if(isset($results))

                <div class="card-body">
                    <table class="table table-striped table-sm" id="catalogFilesTable" cellspacing="0" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('File') }}</th>
                                <th>{{ __('Modification Date') }}</th>
                                <th>{{ __('File size') }}</th>
                                <th>{{ __('Location') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $result)
                                <tr>
                                    <td>{{ $result->fecha }}</td>
                                    <td>{{ $result->file_name }}</td>
                                    <td>{{ $result->ultimo_cambio }}</td>
                                    <td>{{ number_format($result->tamaño / 1024, 2) }}</td>
                                    <td>{{ $result->ruta }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">{{ __('messages.no_records_found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

{{-- Push extra CSS --}}
@push('css')
    <style>
        .radio-spacing {
            margin-right: 10px;
        }

        table{
		    width:100%
        }
    </style>
@endpush

{{-- Enable Plugins --}}
@section('plugins.Datatables', true)
@section('plugins.Select2', true)

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });

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

            $('#catalogFilesTable').DataTable(dataTableConfig);
        });
    </script>
@endpush