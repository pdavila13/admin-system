@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', __('Roles'))
@section('content_header_title', __('List roles'))

{{-- Content body: main page content --}}
@section('content_body')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-primary">{{__('Add') }}</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="roleTable" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Created') }}</th>
                        <th class="text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td class="role-actions text-right">
                                <a href="{{ route('admin.role.edit', encrypt($role->id)) }}" class="btn btn-info btn-xs">
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

{{-- Push extra scripts --}}
@push('js')
    <script>
        $(function() {
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

            $('#roleTable').DataTable(dataTableConfig);
        });
    </script>
@endpush