<x-admin>
    @section('title')
        {{ __('Inventory') }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List inventory') }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="inventoryTable" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Marca') }}</th>
                        <th>{{ __('Model') }}</th>
                        <th>{{ __('Serial Number') }}</th>
                        <th>{{ __('Center') }}</th>
                        <th>{{ __('AET') }}</th>
                        <th>{{ __('Modality') }}</th>
                        <th>{{ __('State Int') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataFromFacade as $item)
                        <tr>
                            <td>{{ $item->tipo_def }}</td>
                            <td>{{ $item->def }}</td>
                            <td>{{ $item->marca_def }}</td>
                            <td>{{ $item->modelo_def }}</td>
                            <td>{{ $item->codigo }}</td>
                            <td>{{ $item->centro_def }}</td>
                            <td>{{ $item->aet}}</td>
                            <td>{{ $item->modality }}</td>
                            <td>{{ $item->estat_integracio_descripcio }}</td>
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

                $('#inventoryTable').DataTable(dataTableConfig);
            });
        </script>
    @endsection
</x-admin>
