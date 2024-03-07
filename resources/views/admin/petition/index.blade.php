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
            <table class="table table-striped petitions" id="petitionTable">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Petition type</th>
                        <th>Petition number</th>
                        <th>SysAdmin</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $petition)
                        <tr>
                            <td>
                                {{ $petition->company->name }}
                                <br>
                                <small>Created {{ $petition->created_at }}</small>
                            </td>
                            <td>{{ $petition->petitionType->name }}</td>
                            <td>{{ $petition->petition_number }}</td>
                            <td>{{ $petition->user->name }}</td>
                            <td>{{ $petition->created_at }}</td>
                            <td class="petition-state">
                                @if ($petition->state->id == '3')
                                    <span class="badge badge-success">Success</span>
                                @elseif ($petition->state->id == '1')
                                    <span class="badge badge-secondary">On Hold</span>
                                @elseif ($petition->state->id == '2')
                                    <span class="badge badge-danger">Canceled</span>
                                @endif
                            </td>
                            <td class="petition-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.petition.edit', encrypt($petition->id)) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('admin.petition.destroy', encrypt($petition->id)) }}" method="POST" onsubmit="return confirm('Are sure want to delete?')" style="display: inline;">
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
    @section('css')
        <style>
            .petition-state .petition-actions {
                text-align: center;
            }
            .petitions td {
                vertical-align: middle;
            }
        </style>
    @endsection
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
