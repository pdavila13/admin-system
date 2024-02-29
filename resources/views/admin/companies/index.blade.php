<x-admin>
    @section('title')
        {{ 'EMPRESES' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabla Empreses</h3>
            <div class="card-tools">
                <a href="{{ route('admin.company.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="group_vpnTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>CIF</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->cif }}</td>
                            <td>{{ $company->description }}</td>
                            <td><a href="{{ route('admin.company.edit', encrypt($company->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.company.destroy', encrypt($company->id)) }}" method="POST" onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @section('js')
        <script>
            $(function() {
                $('#group_vpnTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
