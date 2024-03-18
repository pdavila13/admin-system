<x-admin>
    @section('title')
        {{ __('VPN Groups') }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('VPN Groups List') }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.group_vpn.create') }}" class="btn btn-sm btn-primary">{{__('New') }}</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="group_vpnTable">
                <thead>
                    <tr>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Network') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $group_vpn)
                        <tr>
                            <td>{{ $group_vpn->company->name}}</td>
                            <td>{{ $group_vpn->name }}</td>
                            <td>{{ $group_vpn->network }}</td>
                            <td>{{ $group_vpn->description }}</td>
                            <td class="group_vpn-actions text-right">
                                <a href="{{ route('admin.group_vpn.edit', encrypt($group_vpn->id)) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.group_vpn.destroy', encrypt($group_vpn->id)) }}" method="POST" onsubmit="return confirm('{{ __('Are sure want to delete?') }}')" style="display: inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
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
    @section('js')
        <script>
            $(function() {
                $('#group_vpnTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": false,
                    "responsive": false,
                });
            });
        </script>
    @endsection
</x-admin>
