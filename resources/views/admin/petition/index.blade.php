<x-admin>
    @section('title')
        {{ 'Petition' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Petition Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.petition.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="petitionTable">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Petition type</th>
                        <th>Petition number</th>
                        <th>Technical system</th>
                        <th>Petition data</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $petition)
                        <tr>
                            <td>{{ $petition->name }}</td>
                            <td><a href="{{ route('admin.petition.edit', encrypt($petition->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.petition.destroy', encrypt($petition->id)) }}" method="POST"
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
                $('#petitionTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": false,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
