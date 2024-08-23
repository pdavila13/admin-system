<form class="needs-validation" novalidate action="{{ route('admin.tipus_aparell.update', $equipment_type->idtipus_aparell) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $equipment_type->idtipus_aparell }}">    
    <div class="modal fade text-left" id="ModalEquipmentTypeEdit{{$equipment_type->idtipus_aparell}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit equipment type') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row">                            
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcio">{{ __('Description') }}</label>
                                <textarea type="text" class="form-control" id="descripcio" name="descripcio"
                                    placeholder="Enter equipment description">{{ $equipment_type->descripcio }}</textarea>
                            </div>
                            @error('descripcio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    {!! Form::submit( __('Save changes'), ['class' => 'btn btn-info float-right']) !!}
                </div>
            </div>
        </div>
    </div>
</form>