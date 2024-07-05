<div class="row">
    <div class="col-md-3">
        <div class="row">
            <div class="col">
                <h3 class="card-title">{{ __('Device data') }}</h3><br>
                <hr>
                <div class="form-group">
                    {!! Form::label('def', __('Equipment description')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-laptop-medical"></i></span>
                        </div>
                        {!! Form::text('def', old('def'), ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                    @error('def')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('tipus_aparell', __('Equipment type')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-prescription"></i></span>
                        </div>
                        {!! Form::select('tipus_aparell', [''] + $dataFromFacadeTypeOfDevice->pluck('descripcio', 'idtipus_aparell')->toArray(), old('tipus_aparell'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                    </div>
                    @error('tipus_aparell')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="form-group">
                    {!! Form::label('modality', __('Modality')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                        </div>
                        {!! Form::text('modality', old('modality'), ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                    @error('modality')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="row">
            <div class="col">
                <h3 class="card-title">{{ __('Manufacturer information') }}</h3><br>
                <hr>
                <div class="form-group">
                    {!! Form::label('codigo', __('Serial Number')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                        </div>
                        {!! Form::text('codigo', old('codigo'), ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                    @error('codigo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('marca', __('Trademark')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                        </div>
                        {!! Form::select('marca', [''] + $dataFromFacadeTrademark->pluck('DEF', 'ID')->toArray(), old('marca'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                    </div>
                    @error('marca')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    {!! Form::label('modelo', __('Model')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
                        </div>
                        {!! Form::select('modelo', [''] + $dataFromFacadeModel->pluck('def', 'id')->toArray(), old('modelo'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                    </div>
                    @error('modelo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="row">
            <div class="col">
                <h3 class="card-title">{{ __('Location') }}</h3><br>
                <hr>
                <div class="form-group">
                    {!! Form::label('area', 'Area') !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        {!! Form::select('area', $dataFromFacadeArea->pluck('def', 'id'), $dataFromFacadeAreaFromElemento->area_id, ['class' => 'form-control select2 select2-bootstrap4', 'placeholder' => __(''), 'required' => 'required']) !!}
                    </div>
                    @error('area')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('centro', __('Center')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-house-medical"></i></span>
                        </div>
                        {!! Form::select('centro', [''] + $dataFromFacadeCenter->pluck('def', 'id')->toArray(), old('centro'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                    </div>
                    @error('centro')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('ubicacio', __('Floor')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                </div>
                                {!! Form::select('ubicacio', [''] + $dataFromFacadeFloor->toArray(), old('ubicacio'), ['class' => 'form-control select2 select2-bootstrap4']) !!}
                            </div>
                            @error('ubicacio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('sala', __('Room')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-thumbtack"></i></span>
                                </div>
                                {!! Form::text('sala', old('sala'), ['class' => 'form-control']) !!}
                            </div>
                            @error('sala')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="row">
            <div class="col">
                <h3 class="card-title">{{ __('Service') }}</h3><br>
                <hr>
                <div class="form-group">
                    {!! Form::label('his', __('HIS')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-biohazard"></i></span>
                        </div>
                        {!! Form::select('his', ['', 'ECAP' => 'ECAP', 'SAP' => 'SAP'], old('his'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                    </div>
                </div>
                @error('his')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    {!! Form::label('comentari', __('Service description')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-hand-holding-medical"></i></span>
                        </div>
                        {!! Form::text('comentari', old('comentari'), ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
                @error('comentari')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    {!! Form::label('estat_integracio', __('Evolutionary State')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-paper-plane"></i></span>
                        </div>
                        {!! Form::select('estat_integracio', $dataFromFacadeIntegrationState->pluck('descripcio', 'idestat_integracio')->toArray(), old('estat_integracio'), ['class' => 'form-control select2 select2-bootstrap4']) !!}
                    </div>
                    @error('estat_integracio')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>