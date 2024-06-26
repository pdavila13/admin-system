<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Latest petitions') }}</h3>
        </div>
        
        <div class="card-body">
            <table class="table table-striped petitions" id="latestPetitionTable" style="width:100%">
                <thead>
                    <tr>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Petition type') }}</th>
                        <th>{{ __('Petition number') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($petitions as $petition)
                        <tr>
                            <td>
                                {{ $petition->company->name }}
                                <br>
                                <small>{{ $petition->description }}</small>
                            </td>
                            <td>{{ $petition->petitionType->name }}</td>
                            <td>
                                @if ($petition->petitionType->name == 'Firewall JX')
                                    <a href="{{ env('TASKS_URL') . $petition->petition_number }}" target="_blank">{{ $petition->petition_number }}</a>
                                @else
                                    {{ $petition->petition_number }}
                                @endif
                            </td>
                            <td>
                                @if($petition->datepicker)
                                    {{ DateTime::createFromFormat('Y-m-d H:i:s', $petition->datepicker)->format('d-m-Y') }}
                                @endif
                            </td>
                            <td class="petition-state">
                                @if ($petition->state->id == '3')
                                    <span class="badge badge-success">{{ __('Success') }}</span>
                                @elseif ($petition->state->id == '1')
                                    <span class="badge badge-warning">{{ __('On Hold') }}</span>
                                @elseif ($petition->state->id == '2')
                                    <span class="badge badge-danger">{{ __('Canceled') }}</span>
                                @endif
                            </td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ModalPetitionEdit{{ $petition->id }}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    @foreach ($petitions as $petition)
                                        @include('admin.petition.modal.modal-edit', ['petition' => $petition])
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@section('js')
    <script>
        $(document).ready(function() {
            var selectedLanguage = 'ca';
            var dataTableConfig = {
                paging: true,
                searching: true,
                ordering: false,
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/' + selectedLanguage + '.json'
                },
                order: [
                    [3, 'desc']
                ]
            };

            $('#latestPetitionTable').DataTable(dataTableConfig);
            
            $('.datetimepicker').each(function() {
                $(this).datetimepicker({
                    dropdownParent: $(this).closest('.modal'),
                    format: 'DD-MM-YYYY',
                });
            });
        });
    </script>
@endsection