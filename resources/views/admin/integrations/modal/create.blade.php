{!! Form::open(['route' => 'admin.integration.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="modal fade text-left" id="ModalIntegrationCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Create new integration') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="container-fluid">
                            @include('admin.integrations.partials.form-electro')
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}