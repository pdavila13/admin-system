<div class="modal fade text-left" id="ModalIntegrationShow{{ $elemento->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Integration data') }} <b>{{ $elemento->id }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                    
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="container-fluid">
                        <h3 class="text-primary">{{ $elemento->centro_def }}</h3>
                        <p class="text-muted">{{ $elemento->def }}</p> <br>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('Tipus') }}</b>
                                        <p class="text-sm">{{ $elemento->tipo_def }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('Trademark') }}</b>
                                        <p class="text-sm">{{ $elemento->marca_def }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('Model') }}</b>
                                        <p class="text-sm">{{ $elemento->modelo_def }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('IP') }}</b>
                                        <p class="text-sm">{{ !empty($elemento->ip) ? $elemento->ip : 'N/D' }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('Serial') }}</b>
                                        <p class="text-sm">{{ !empty($elemento->codigo) ? $elemento->codigo : 'N/D' }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('Perfil') }}</b>
                                        <p class="text-sm">{{ $elemento->perfil_def }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('Updated') }}</b>
                                        <p class="text-sm">{{ $elemento->fecha }}</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <h4 class="text-secondary">{{ __('Digital image') }}</h3>
                            <div class="row">
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('Equipment type') }}</b>
                                        <p class="text-sm">{{ !empty($elemento->tipus_aparell_def) ? $elemento->tipus_aparell_def : 'N/D' }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('AET') }}</b>
                                        <p class="text-sm">{{ !empty($elemento->aet) ? $elemento->aet : 'N/D' }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('Modality') }}</b>
                                        <p class="text-sm">{{ !empty($elemento->modality) ? $elemento->modality : 'N/D' }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('MQ code') }}</b>
                                        <p class="text-sm">{{ !empty($elemento->maquina_sap) ? $elemento->maquina_sap : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('UT') }}</b>
                                        <p class="text-sm">{{ !empty($elemento->ut) ? $elemento->ut : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-muted">
                                        <b class="d-block">{{ __('Point') }}</b>
                                        <p class="text-sm">{{ !empty($elemento->roseta) ? $elemento->roseta : 'N/D' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>