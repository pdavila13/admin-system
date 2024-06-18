<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('maquina_sap', __('MQ code')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                </div>
                {!! Form::text('maquina_sap', old('maquina_sap'), ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
            @error('maquina_sap')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-notes-medical"></i></span>
                </div>
                <input type="text" class="form-control" id="description" name="description"
                    placeholder="" required value=""></input>
            </div>
        </div>
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="marca">{{ __('Servei') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hand-holding-medical"></i></span>
                </div>
                <input type="text" class="form-control" id="marca" name="marca"
                    placeholder="" required value="">
            </div>
        </div>
        @error('marca')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('ut', __('UT')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-heart"></i></span>
                </div>
                {!! Form::text('ut', old('ut'), ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
            @error('ut')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>