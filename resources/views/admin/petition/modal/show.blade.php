<div class="modal fade text-left" id="ModalPetitionShow{{ $petition->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Detail petition') }} <b>{{ $petition->petition_number }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                    
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">                        
                        <div class="col-md-4">
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
                                        <p class="text-sm">{{ $petition->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 ms-auto">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Files') }}</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('File name') }}</th>
                                                <th>{{ __('File size') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($files as $file)
                                                <tr>
                                                    <td>{{ basename($file) }}</td>
                                                    <td>{{ round(Storage::size($file) / 1024, 4) }} kb</td>
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
        </div>
    </div>
</div>