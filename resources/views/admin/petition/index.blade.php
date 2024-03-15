<x-admin>
    @section('title')
        {{ __('Petitions') }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List petitions') }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.petition.create') }}" class="btn btn-sm btn-info">{{ __('New') }}</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped petitions" id="petitionTable">
                <thead>
                    <tr>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Petition type') }}</th>
                        <th>{{ __('Petition number') }}</th>
                        <th>{{ __('Technical System') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $petition)
                        <tr>
                            <td>
                                {{ $petition->company->name }}
                                <br>
                                <small>{{ __('Created') }} {{ $petition->created_at }}</small>
                            </td>
                            <td>{{ $petition->petitionType->name }}</td>
                            <td>{{ $petition->petition_number }}</td>
                            <td>{{ $petition->user->name }}</td>
                            <td>
                                @if($petition->datepicker)
                                    {{ DateTime::createFromFormat('Y-m-d H:i:s', $petition->datepicker)->format('d-m-Y') }}
                                @endif
                            </td>
                            <td class="petition-state">
                                @if ($petition->state->id == '3')
                                    <span class="badge badge-success">{{ __('Success') }}</span>
                                @elseif ($petition->state->id == '1')
                                    <span class="badge badge-secondary">{{ __('On Hold') }}</span>
                                @elseif ($petition->state->id == '2')
                                    <span class="badge badge-danger">{{ __('Canceled') }}</span>
                                @endif
                            </td>
                            <td class="petition-actions text-right">
                                <a href="{{ route('admin.petition.show', encrypt($petition->id)) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.petition.edit', encrypt($petition->id)) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.petition.destroy', encrypt($petition->id)) }}" method="POST" onsubmit="return confirm('{{ __('Are sure want to delete?') }}')" style="display: inline;">
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
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
