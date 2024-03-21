<x-admin>
    @section('title')
        {{ __('Petition detail') }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Company') }}: {{ $petition->company->name }}</h3>
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
                                <input type="text" id="petition_number" class="form-control" value="{{ $petition->petition_number }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea id="description" class="form-control" rows="4" disabled>{{ $petition->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="petitionType">{{ __('Petition type') }}</label>
                                <input type="text" id="petitionType" class="form-control" value="{{ $petition->petitionType->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="state">{{ __('Status') }}</label>
                                <input type="text" id="state" class="form-control" value="{{ $petition->state->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="user">{{ __('Technical system') }}</label>
                                <input type="text" id="user" class="form-control" value="{{ $petition->user->name }}" disabled>
                            </div>
                        </div>
                    </div>    
                </div>
                
                <div class="col-md-6">
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
</x-admin>
