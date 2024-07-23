{!! Form::open(['route' => ['admin.integration.destroy', encrypt($elemento->id)], 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) !!}
    <div class="modal fade text-left" id="ModalIntegrationDelete{{ $elemento->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Integration disable') }} <b>{{ $elemento->aet }}</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>   
                <div class="modal-body"> {{ __('You sure you want to disable') }}</div>
                <div class="modal-footer">
                    <button type="button" class="btn gray btn-outline-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-outline-danger">{{ __('Disable') }}</button>
                </div>
            </div>
        </div>
    </div>   
{!! Form::close() !!}