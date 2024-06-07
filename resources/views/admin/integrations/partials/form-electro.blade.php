<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dades de l'aparell</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('tipus_aparell', __('Type equipment')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-laptop-medical"></i></span>
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
                                {!! Form::select('modality[]', $dataFromFacadeModalities->pluck('modality', 'id')->toArray(), old('modality', []), ['class' => 'form-control select2 select2-bootstrap4', 'multiple' => 'multiple', 'required' => 'required']) !!}
                            </div>
                            @error('modality')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::label('fecha', __('Fecha'), ['class' => 'form-label']) !!}
                            <div class="input-group date datetimepicker" data-target-input="nearest">
                                {!! Form::text('fecha', old('fecha'), ['class' => 'form-control datetimepicker-input', 'data-target' => '.datetimepicker']) !!}
                                <div class="input-group-append" data-target=".datetimepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @error('fecha')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Dades del fabricant</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
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
                            {!! Form::label('modelo', __('modelo')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
                                </div>
                                {!! Form::select('modelo', ['' => __('Selecciona un modelo')] +$dataFromFacadeModel->pluck('def', 'id')->toArray(), old('modelo'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                            </div>
                            @error('modelo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Ubicació</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('zona', __('Zona')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hospital"></i></span>
                                </div>
                                {!! Form::select('zona', ['' => __('Selecciona una zona')] + $dataFromFacadeArea->pluck('def', 'id')->toArray(), old('zona'), ['class' => 'form-control select2-bootstrap4', 'required' => 'required']) !!}
                            </div>
                            @error('zona')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::label('centro', __('Centre')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hospital-user"></i></span>
                                </div>
                                {!! Form::select('centro', ['' => __('Selecciona un centre')], old('centro'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                            </div>
                            @error('centro')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {!! Form::label('planta', __('Planta')) !!}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                        </div>
                                        {!! Form::select('planta', [], old('planta'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                                    </div>
                                    @error('planta')
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
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Servei</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="his">{{ __('HIS') }}</label>
                            <select name="his" id="his" class="form-control" required>
                                <option value="" selected></option>
                                <option value="1">ECAP</option>
                                <option value="2">SAP</option>
                            </select>
                        </div>
                        @error('equip')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="modality">{{ __('Nom servei') }}</label>
                            <input type="text" class="form-control" id="modality" name="modality"
                                placeholder="" required value="">
                        </div>
                        @error('modality')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Informació addicional</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea type="text" class="form-control" id="description" name="description"
                                placeholder="" style="height: 124px;"></textarea>
                        </div>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>