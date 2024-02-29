<x-admin>
    @section('title')
        {{ 'VPN3e EMPRESES' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabla VPN3e Empreses</h3>
            <div class="card-tools">
                <a href="{{ route('admin.group_vpn.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="group_vpnTable">
                <thead>
                    <tr>
                        <th>Group VPN</th>
                        <th>Network</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $group_vpn)
                        <tr>
                            <td>{{ $group_vpn->name }}</td>
                            <td>{{ $group_vpn->network }}</td>
                            <td>{{ $group_vpn->description }}</td>
                            <td><a href="{{ route('admin.group_vpn.edit', encrypt($group_vpn->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.group_vpn.destroy', encrypt($group_vpn->id)) }}" method="POST" onsubmit="return confirm('Are sure want to delete?')">
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
