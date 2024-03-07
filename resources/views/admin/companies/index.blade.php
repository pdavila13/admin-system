<x-admin>
    @section('title')
        {{ 'Company' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Company Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.company.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="companyTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>CIF</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $com)
                        <tr>
                            <td>{{ $com->name }}</td>
                            <td>{{ $com->cif }}</td>
                            <td>{{ $com->description }}</td>
                            <td class="text-right"><a href="{{ route('admin.company.edit', encrypt($com->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td class="text-right">
                                <form action="{{ route('admin.company.destroy', encrypt($com->id)) }}" method="POST" 
                                    onsubmit="return confirm('Are sure want to delete?')">
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
                $('#companyTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>