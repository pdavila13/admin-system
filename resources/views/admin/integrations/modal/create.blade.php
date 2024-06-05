<form class="needs-validation" novalidate action="{{ route('admin.integration.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
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
                                                            <label for="equip">{{ __('Tipus aparell') }}</label>
                                                            <select name="equip" id="equip" class="form-control select2 select2-bootstrap4" required>
                                                                <option value="" selected disabled></option>
                                                                @foreach ($dataFromFacadeTypeOfDevice as $typeOfDevice)
                                                                    <option {{ old('equip') == $typeOfDevice->idtipus_aparell ? 'selected' : '' }} value="{{ $typeOfDevice->idtipus_aparell }}">{{ $typeOfDevice->descripcio }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('equip')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    
                                                        <div class="form-group">
                                                            <label for="modality">{{ __('Modality') }}</label>
                                                            <select name="modality[]" id="modality" class="form-control select2 select2-bootstrap4" multiple required>
                                                                @foreach ($dataFromFacadeModalities as $moda)
                                                                    <option {{ in_array($moda->id, old('modality', [])) ? 'selected' : '' }} value="{{ $moda->modality }}">{{ $moda->modality }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('modality')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        <div class="form-group">
                                                            <label for="datepicker" class="form-label">{{ __('Date') }}</label>
                                                            <div class="input-group date datetimepicker" data-target-input="nearest">
                                                                <input type="text" name="datepicker" class="form-control datetimepicker-input" data-target=".datetimepicker" 
                                                                value="">
                                                                <div class="input-group-append" data-target=".datetimepicker" data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                            @error('datepicker')
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
                                                            <label for="serial">{{ __('Nº Serie') }}</label>
                                                            <input type="text" class="form-control" id="serial" name="serial"
                                                                placeholder="" required value="">
                                                        </div>
                                                        @error('serial')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                        <div class="form-group">
                                                            <label for="trademark">{{ __('Marca') }}</label>
                                                            <select name="trademark" id="trademark" class="form-control select2 select2-bootstrap4" required>
                                                                <option value="" selected></option>
                                                                @foreach ($dataFromFacadeTrademark as $tradeMark)
                                                                    <option {{ old('trademark') == $tradeMark->ID ? 'selected' : '' }} value="{{ $tradeMark->ID }}">{{ $tradeMark->DEF }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('trademark')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        
                                                        <div class="form-group">
                                                            <label for="model">{{ __('Model') }}</label>
                                                            <select name="model" id="model" class="form-control select2 select2-bootstrap4" required>
                                                                <option value="" selected></option>
                                                            </select>
                                                        </div>
                                                        @error('model')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                            </div>
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>