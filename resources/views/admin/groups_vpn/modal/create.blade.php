<form class="needs-validation" novalidate action="{{ route('admin.group_vpn.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal face text-left" id="ModalGroupVPNCreate" role="dialog" aria-hidden="true" data-focus="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Create new group VPN') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
                            </div>
                            @error('name')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="company">{{ __('Company') }}</label>
                                <select class="form-control select2 select2-bootstrap4" name="company_id" id="company" required>
                                    <option value="" selected disabled>{{ __('Select company') }}</option>
                                    @foreach ($companies as $company)
                                        @if ($company->active == 1)
                                            <option {{ old('company_id') == $company->id ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('company_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                            
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="network" class="form-label">{{ __('Network') }}</label>
                                <input type="text" name="network" class="form-control" required value="{{ old('network') }}">
                            </div>
                            @error('network')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea type="text" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>