<div class="row">
    <div class="col-md-3">
        <div class="row">
            <div class="col">
                <h3 class="card-title">Dades de l'aparell</h3><br>
                <hr>
                <div class="form-group">
                    {!! Form::label('def', __('Description equipment')) !!}
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
                    {!! Form::label('tipus_aparell', __('Type equipment')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-prescription"></i></span>
                        </div>
                        {!! Form::select('tipus_aparell', ['' => __('Selecciona un tipo')] + $dataFromFacadeTypeOfDevice->pluck('descripcio', 'idtipus_aparell')->toArray(), old('tipus_aparell'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
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
                <h3 class="card-title">Dades del fabricant</h3><br>
                <hr>
                <div class="form-group">
                    {!! Form::label('codigo', __('Nº Serie')) !!}
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
                    {!! Form::label('marca', __('Marca')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                        </div>
                        {!! Form::select('marca', ['' => __('Selecciona una marca')] + $dataFromFacadeTrademark->pluck('DEF', 'ID')->toArray(), old('marca'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
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
                        {!! Form::select('modelo', ['' => __('Selecciona un modelo')] + $dataFromFacadeModel->pluck('def', 'id')->toArray(), old('modelo'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
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
                <h3 class="card-title">Ubicació</h3><br>
                <hr>
                <div class="form-group">
                    {!! Form::label('area', 'Area') !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        {!! Form::select('area', $dataFromFacadeArea->pluck('def', 'id'), $dataFromFacadeAreaFromElemento->area_id, ['class' => 'form-control select2 select2-bootstrap4', 'placeholder' => 'Seleccione un área']) !!}
                    </div>
                    @error('area')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('centro', __('Centre')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-hospital-user"></i></span>
                        </div>
                        {!! Form::select('centro', ['' => __('Selecciona un centro')] + $dataFromFacadeCenter->pluck('def', 'id')->toArray(), old('centro'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                    </div>
                    @error('centro')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('ubicacio', __('Planta')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                </div>
                                {!! Form::select('ubicacio', ['' => __('Select')] + $dataFromFacadeFloor->toArray(), old('ubicacio'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                            </div>
                            @error('ubicacio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('sala', __('Sala')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-thumbtack"></i></span>
                                </div>
                                {!! Form::text('sala', old('sala'), ['class' => 'form-control', 'required' => 'required']) !!}
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
                <h3 class="card-title">Servei</h3><br>
                <hr>
                <div class="form-group">
                    {!! Form::label('his', __('HIS')) !!}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-biohazard"></i></span>
                        </div>
                        {!! Form::select('his', ['' => __('Selecciona un HIS'), 'ECAP' => 'ECAP', 'SAP' => 'SAP'], old('his'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                    </div>
                </div>
                @error('his')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    {!! Form::label('comentari', __('Service name')) !!}
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
            </div>
        </div>
    </div>
</div>