<x-admin>
    @section('title')
        {{ __('Petition detail') }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Company') }}: {{ $data->company->name }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.petition.index') }}" class="btn btn-info btn-sm">{{ __('Back') }}</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('General') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="petition_number">{{ __('Petition number') }}</label>
                                <input type="text" id="petition_number" class="form-control" value="{{ $data->petition_number }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea id="description" class="form-control" rows="4" disabled>{{ $data->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="petitionType">{{ __('Petition type') }}</label>
                                <input type="text" id="petitionType" class="form-control" value="{{ $data->petitionType->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="state">{{ __('Status') }}</label>
                                <input type="text" id="state" class="form-control" value="{{ $data->state->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="user">{{ __('Technical system') }}</label>
                                <input type="text" id="user" class="form-control" value="{{ $data->user->name }}" disabled>
                            </div>
                        </div>
                    </div>    
                </div>
                
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Files</h3>
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
                                    <th>File Name</th>
                                    <th>File Size</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>Functional-requirements.docx</td>
                                    <td>49.8005 kb</td>
                                    <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                    </td>
                                    <tr>
                                    <td>UAT.pdf</td>
                                    <td>28.4883 kb</td>
                                    <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                    </td>
                                    <tr>
                                    <td>Email-from-flatbal.mln</td>
                                    <td>57.9003 kb</td>
                                    <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                    </td>
                                    <tr>
                                    <td>Logo.png</td>
                                    <td>50.5190 kb</td>
                                    <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                    </td>
                                    <tr>
                                    <td>Contract-10_12_2014.docx</td>
                                    <td>44.9715 kb</td>
                                    <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
</x-admin>
