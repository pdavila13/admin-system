
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Latest petitions') }}</h3>
        </div>
        
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Petition type') }}</th>
                        <th>{{ __('Petition number') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($petitions as $petition)
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td>{{ $petition->company->name }}</td>
                            <td>{{ $petition->petitionType->name }}</td>
                            <td>{{ $petition->petition_number }}</td>
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
                        </tr>
                        <tr class="expandable-body">
                            <td colspan="5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-muted">
                                            <p class="text-sm">
                                                <b class="d-block">{{ __('Description') }}</b>
                                            </p>
                                            <p>{!! nl2br(e($petition->description)) !!}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted">
                                            <p class="text-sm">
                                                <b class="d-block">{{ __('Technical system') }}</b>
                                            </p>
                                            <p>{{ $petition->user->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

