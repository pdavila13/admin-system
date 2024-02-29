<x-admin>
    @section('title')
        {{ 'VPN3e EMPRESES' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabla VPN3e Empreses</h3>
            <div class="card-tools">
                <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="productTable">
                <thead>
                    <tr>
                        <th>Group VPN</th>
                        <th>Company</th>
                        <th>Network</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $product)
                        <tr>
                            <td>{{ $product->vpn3e_group }}</td>
                            <td>{{ $product->vpn3e_company }}</td>
                            <td>{{ $product->vpn3e_network }}</td>
                            <td>{{ $product->vpn3e_description }}</td>
                            <td><a href="{{ route('admin.product.edit', encrypt($product->id)) }}"
                                    class="btn btn-sm btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.product.destroy', encrypt($product->id)) }}" method="POST" onsubmit="return confirm('Are sure want to delete?')">
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
                $('#productTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
