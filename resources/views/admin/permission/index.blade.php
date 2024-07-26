@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Permissions'))
@section('content_header')
    @can('admin.permission.create')
        <a href="{{ route('admin.permission.create') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i></a>
    @endcan
    <h1 class="text-muted">{{ __('List permissions') }}</h1>
@stop

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="permissionTable">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Created') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->created_at }}</td>
                            <td class="permission-actions text-right">
                                <a href="{{ route('admin.permission.edit', encrypt($permission->id)) }}" class="btn btn-info btn-xs">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.permission.destroy', encrypt($permission->id)) }}" method="POST" onsubmit="return confirm('{{ __('Are sure want to delete?') }}')" style="display: inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-xs">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center bg-danger">{{ __('Permission not created') }}</td>
                        </tr>
                    @endforelse
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
                ordering: true,
                responsive: true,
                autoWidth: false,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/ca.json'
                }
            };

            $('#permissionTable').DataTable(dataTableConfig);
        });
    </script>
@endpush