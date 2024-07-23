<div class="row">
    <div class="col-lg-2">
        <div class="form-group">
            {!! Form::label('maquina_sap', __('MQ code')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                </div>
                {!! Form::text('maquina_sap', old('maquina_sap'), ['class' => 'form-control']) !!}
            </div>
            @error('maquina_sap')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('maquina_sap_desc', __('MQ Description')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-notes-medical"></i></span>
                </div>
                {!! Form::text('maquina_sap_desc', old('maquina_sap_desc'), ['class' => 'form-control']) !!}
            </div>
        </div>
        @error('maquina_sap_desc')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-lg-2">
        <div class="form-group">
            {!! Form::label('servei', __('Servei')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hand-holding-medical"></i></span>
                </div>
                {!! Form::text('servei', old('servei'), ['class' => 'form-control']) !!}
            </div>
        </div>
        @error('servei')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('ut', __('UT')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-heart"></i></span>
                </div>
                {!! Form::text('ut', old('ut'), ['class' => 'form-control']) !!}
            </div>
            @error('ut')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>