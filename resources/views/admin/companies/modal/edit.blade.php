<form class="needs-validation" novalidate action="{{ route('admin.company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $company->id }}">
    <div class="modal fade text-left" id="ModalCompanyEdit{{$company->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit company') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">{{ __('Company name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter company name" required value="{{ $company->name }}">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cif">{{ __('CIF') }}</label>
                                <input type="text" class="form-control" id="cif" name="cif"
                                    placeholder="Enter company cif" required value="{{ $company->cif }}">
                            </div>
                            @error('cif')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                            
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea type="text" class="form-control" id="description" name="description"
                                    placeholder="Enter company description">{{ $company->description }}</textarea>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>