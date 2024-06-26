{!! Form::model($dataFromFacadeElemento, ['route' => ['admin.integration.update', $dataFromFacadeElemento], 'method' => 'put']) !!}
    {!! Form::hidden('id', $dataFromFacadeElemento->id) !!}
    <div class="modal fade text-left" id="ModalIntegrationEdit{{$dataFromFacadeElemento->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit integration') }} {{ $dataFromFacadeElemento->id }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="false">Electromedicina</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Oficina SAP</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Informàtica</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                    <div class="container-fluid">
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
                                                                    {!! Form::label('tipus_aparell', __('Tipus aparell')) !!}
                                                                    {!! Form::select('tipus_aparell', ['' => __('Selecciona un tipo')] + $dataFromFacadeTypeOfDevice->pluck('descripcio', 'idtipus_aparell')->toArray(), old('tipus_aparell'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                                                                    @error('tipus_aparell')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            
                                                                <div class="form-group">
                                                                    {!! Form::label('modality', __('Modality')) !!}
                                                                    {!! Form::select('modality[]', $dataFromFacadeModalities->pluck('modality', 'id')->toArray(), old('modality', []), ['class' => 'form-control select2 select2-bootstrap4', 'multiple' => 'multiple', 'required' => 'required']) !!}
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
                                                                    <label for="trademark">{{ __('Marca') }}</label>
                                                                    <select name="trademark" id="trademark" class="form-control select2 select2-bootstrap4" required>
                                                                        {{-- @foreach ($dataFromFacadeTrademark as $trademark)
                                                                            <option {{ $elemento->marca == $trademark->ID ? 'selected' : '' }} value="{{ $trademark->ID }}">{{ $trademark->DEF }}</option>
                                                                        @endforeach --}}
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label for="model">{{ __('Model') }}</label>
                                                                    <select name="model" id="model" class="form-control select2 select2-bootstrap4" required>
                                                                        <option value="" selected></option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="serial">{{ __('Nº Serie') }}</label>
                                                                    <input type="text" class="form-control" id="serial" name="serial"
                                                                        placeholder="" required value="{{ $item->codigo }}">
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
                                                                    <label for="zona">{{ __('Zona') }}</label>
                                                                    <select name="zona" id="zona" class="form-control select2-bootstrap4" required>
                                                                        <option value="" selected></option>
                                                                        @foreach ($dataFromFacadeArea as $area)
                                                                            <option {{ old('zona') == $area->id ? 'selected' : '' }} value="{{ $area->id }}">{{ $area->def }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('zona')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
        
                                                                <div class="form-group">
                                                                    <label for="center">{{ __('Centre') }}</label>
                                                                    <select name="center" id="center" class="form-control select2 select2-bootstrap4" required>
                                                                        <option value="" selected></option>
                                                                    </select>
                                                                </div>
                                                                @error('center')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
        
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="planta">{{ __('Planta') }}</label>
                                                                            <select name="planta" id="planta" class="form-control select2 select2-bootstrap4" required>
                                                                                <option value="" selected></option>
                                                                            </select>
                                                                        </div>
                                                                        @error('planta')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="sala">{{ __('Sala') }}</label>
                                                                            <input type="text" class="form-control" id="sala" name="sala"
                                                                                placeholder="" required value="">
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
                                                                    <label for="equip">{{ __('HIS') }}</label>
                                                                    <select name="evolutiu" id="evolutiu" class="form-control" required>
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
                                                                        placeholder="" style="height: 124px;">{{ $item->def }}</textarea>
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
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="equip">{{ __('Codi MQ') }}</label>
                                                <input type="text" class="form-control" id="equip" name="equip"
                                                    placeholder="" required value="">
                                            </div>
                                            @error('equip')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="description">{{ __('Description') }}</label>
                                                <input type="text" class="form-control" id="description" name="description"
                                                    placeholder="" required value=""></input>
                                            </div>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="marca">{{ __('Servei') }}</label>
                                                <input type="text" class="form-control" id="marca" name="marca"
                                                    placeholder="" required value="">
                                            </div>
                                            @error('marca')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="model">{{ __('UT') }}</label>
                                                <input type="text" class="form-control" id="model" name="model"
                                                    placeholder="" required value="">
                                            </div>
                                            @error('model')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>IP mask:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask="" inputmode="decimal">
                                                </div>
                                            </div>

                                            <!--
                                            <div class="form-group">
                                                <label for="equip">{{ __('IP') }}</label>
                                                <input type="text" class="form-control" id="equip" name="equip"
                                                    placeholder="" required value="">
                                            </div>-->
                                            @error('equip')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="marca">{{ __('Mask') }}</label>
                                                <input type="text" class="form-control" id="marca" name="marca"
                                                    placeholder="" required value="">
                                            </div>
                                            @error('marca')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="model">{{ __('Gateway') }}</label>
                                                <input type="text" class="form-control" id="model" name="model"
                                                    placeholder="" required value="">
                                            </div>
                                            @error('model')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="marca">{{ __('AET') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="marca" name="marca"
                                                    placeholder="" required value="">
                                                </div>
                                                
                                            </div>
                                            @error('marca')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="model">{{ __('Evolutiu') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-paper-plane"></i></span>
                                                    </div>
                                                    <select name="evolutiu" id="evolutiu" class="form-control" required>
                                                        <option value="1">Integrat</option>
                                                        <option value="2">Enviat eCAP</option>
                                                        <option value="3">Enviat SAP</option>
                                                        <option value="4">Pendent de proves</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @error('model')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
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