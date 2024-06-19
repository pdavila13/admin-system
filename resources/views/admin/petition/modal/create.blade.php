{{ Form::open (['route' => 'admin.petition.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
    <div id="ModalPetitionCreate" class="modal fade text-left" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Create new petition') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    @include('admin.petition.partials.form')
                </div>

                <div class="modal-footer">
                    {{ Form::submit(__('Save'), ['class' => 'btn btn-primary float-right']) }}
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}