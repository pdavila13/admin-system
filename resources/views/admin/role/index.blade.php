@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Roles'))
@section('content_header')
    @can('admin.role.create')
        <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i></a>
    @endcan
    <h1 class="text-muted">{{ __('List roles') }}</h1>
@stop

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="roleTable">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Created') }}</th>
                        <th class="text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td class="role-actions text-right">
                                <a href="{{ route('admin.role.edit', $role) }}" class="btn btn-info btn-xs">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.role.destroy', encrypt($role->id)) }}" method="POST" onsubmit="return confirm('Are sure want to delete?')" style="display: inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-xs">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

{{-- Enable Datatables Plugin --}}
@section('plugins.Datatables', true)

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(function() {
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

            $('#roleTable').DataTable(dataTableConfig);
        });
    </script>
@endpush