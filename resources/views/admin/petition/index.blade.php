<x-admin>
    @section('title')
        {{ __('Petitions') }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('List petitions') }}</h3>
            <div class="card-tools">
                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalPetitionCreate">{{ __('New') }}</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped petitions" id="petitionTable" style="width:100%">
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
                                <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#ModalPetitionShow{{ $petition->id }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ModalPetitionEdit{{ $petition->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalPetitionDelete{{ $petition->id }}">
                                    <i class="fas fa-trash"></i>
                                </a>
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
            $(document).ready(function() {
                var selectedLanguage = 'ca';
                var dataTableConfig = {
                    paging: true,
                    searching: true,
                    ordering: false,
                    responsive: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/' + selectedLanguage + '.json'
                    }
                };
                $('#petitionTable').DataTable(dataTableConfig);

                $('#companySelect2').select2({ 
                    dropdownParent: "#ModalPetitionCreate",
                    theme: 'bootstrap4',
                });

                $('#ModalPetitionCreate').on('show.bs.modal', function() {
                    var currentDate = moment().format('DD-MM-YYYY');
                    $(this).find('.datetimepicker-input').val(currentDate);

                    $(this).find('.datetimepicker').each(function() {
                        $(this).datetimepicker({
                            dropdownParent: $(this).closest('.modal'),
                            format: 'DD-MM-YYYY',
                            defaultDate: new Date(),
                        });
                    });
                });

                $('.datetimepicker').each(function() {
                    $(this).datetimepicker({
                        dropdownParent: $(this).closest('.modal'),
                        format: 'DD-MM-YYYY',
                    });
                });
            });
        </script>
    @endsection

    @include('admin.petition.modal.create')
    
    @foreach ($data as $petition)
        @include('admin.petition.modal.edit', ['petition' => $petition])
        @include('admin.petition.modal.show', ['petition' => $petition, 'files' => $petition->files])
        @include('admin.petition.modal.delete', ['petition' => $petition])
    @endforeach
</x-admin>