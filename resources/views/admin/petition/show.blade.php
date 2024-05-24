<x-admin>
    @section('title')
        {{ __('Petition detail') }}
    @endsection
    <div class="card">
        <!--
        <div class="card-header">
            <h3 class="card-title">Title</h3>
            <div class="card-tools">
                <a href="{{ route('admin.petition.index') }}" class="btn btn-info btn-sm">{{ __('Back') }}</a>
            </div>
        </div>-->
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6 order-2 order-md-2">
                    <h3 class="text-primary">{{ $petition->company->name }}</h3>
                    <p class="text-muted">{{ $petition->company->description }}</p>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="text-muted">
                                <b class="d-block">{{ __('Petition number') }}</b>
                                <p class="text-sm">{{ $petition->petition_number }}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-muted">
                                <b class="d-block">{{ __('Petition type') }}</b>
                                <p class="text-sm">{{ $petition->petitionType->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="text-muted">
                                <b class="d-block">{{ __('Status') }}</b>
                                <p class="text-sm">{{ $petition->state->name }}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-muted">
                                <b class="d-block">{{ __('Technical System') }}</b>
                                <p class="text-sm">{{ $petition->user->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="text-muted">
                                <b class="d-block">{{ __('Description') }}</b>
                                <p class="text-sm">{{ $petition->company->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-12 col-lg-6 order-1 order-md-2">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Files') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('File name') }}</th>
                                        <th>{{ __('File size') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($files as $file)
                                        <tr>
                                            <td>{{ basename($file) }}</td>
                                            <td>{{ round(Storage::size($file) / 1024, 4) }} kb</td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>           
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.petition.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
        </div>
    </div>
</x-admin>
