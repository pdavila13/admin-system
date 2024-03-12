<x-admin>
    @section('title')
        {{ 'Permission' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Permission</h3>
            <div class="card-tools">
                <a href="{{ route('admin.permission.create') }}" class="btn btn-sm btn-primary">Add</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="collectionTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->created_at }}</td>
                            <td class="permission-actions text-right">
                                <a href="{{ route('admin.permission.edit', encrypt($permission->id)) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.permission.destroy', encrypt($permission->id)) }}" method="POST" onsubmit="return confirm('Are sure want to delete?')" style="display: inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center bg-danger">Permission not created</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @section('js')
        <script>
            $(function() {
                $('#collectionTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
