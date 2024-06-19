{{ Form::model ($petition, ['route' => ['admin.petition.update', $petition->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    {{ Form::hidden('id', $petition->id) }}
    <div id="ModalPetitionEdit{{$petition->id}}" class="modal fade text-left" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit petition') }} <b>{{ $petition->petition_number }}</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                
                <div class="modal-body">
                    @include('admin.petition.partials.form')
                </div>

                <div class="modal-footer">
                    {{ Form::submit(__('Save changes'), ['class' => 'btn btn-info float-right']) }}
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}