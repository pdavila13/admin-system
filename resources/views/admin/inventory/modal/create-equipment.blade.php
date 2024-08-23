<form class="needs-validation" novalidate action="{{ route('admin.tipus_aparell.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left" id="ModalEquipmentTypeCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sx" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Create new equipment type') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcio">{{ __('Description') }}</label>
                            <input type="text" class="form-control" id="descripcio" name="descripcio"
                                placeholder="" required value="{{ old('descripcio') }}">
                        </div>
                        @error('descripcio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>