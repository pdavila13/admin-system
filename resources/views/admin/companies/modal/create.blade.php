<form class="needs-validation" novalidate action="{{ route('admin.company.store') }}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="modal fade text-left" id="ModalCompanyCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Create new company') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="" required value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cif">{{ __('CIF') }}</label>
                                <input type="text" class="form-control" id="cif" name="cif"
                                    placeholder="" required value="{{ old('cif') }}">
                            </div>
                            @error('cif')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                            
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea type="text" class="form-control" id="description" name="description"
                                    placeholder="">{{ old('description') }}</textarea>
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