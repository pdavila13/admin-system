<x-admin>
    @section('title')
        {{ __('Companies') }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List companies') }}</h3>
            <div class="card-tools">                
                <a href="{{ route('admin.company.create') }}" class="btn btn-sm btn-primary">{{ __('New') }}</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="companyTable" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('CIF') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $com)
                        <tr>
                            <td>{{ $com->name }}</td>
                            <td>{{ $com->cif }}</td>
                            <td>{{ $com->description }}</td>
                            <td class="company-actions text-right">
                                <a href="{{ route('admin.company.edit', encrypt($com->id)) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.company.destroy', encrypt($com->id)) }}" method="POST" onsubmit="return confirm('{{ __('Are sure want to delete?') }}')" style="display: inline;">
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
                var selectedLanguage = 'ca';
                var dataTableConfig = {
                    paging: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/' + selectedLanguage + '.json'
                    }
                };

                $('#companyTable').DataTable(dataTableConfig);
            });
        </script>
    @endsection
</x-admin>