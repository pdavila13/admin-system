{!! Form::open(['route' => 'admin.catalog.search', 'method' => 'POST']) !!}
    <div class="row">
        <!-- Input de Filename -->
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('file_name', __('File name')) !!}
                {!! Form::text('file_name', old('file_name', $file_name ?? ''), ['class' => 'form-control', 'placeholder' => __('Intro the name file'), 'required' => 'required']) !!}
            </div>
        </div>

        <!-- Checkbox Última versión -->
        <div class="col-md-2">
            <div class="form-group">
                <br>
                {!! Form::checkbox('latest_version', 'on', old('latest_version', $latest_version ?? false), ['id' => 'latest_version']) !!}
                {!! Form::label('latest_version', __('Lastest Version')) !!}
            </div>
        </div>

        <!-- Radios de ruta -->
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('ruta', __('Select Location')) !!}
                <div class="row">
                    <div class="radio-spacing">
                        {!! Form::radio('ruta', 'kesse', old('ruta', $ruta ?? '') === 'kesse', ['id' => 'kesse']) !!}
                        {!! Form::label('kesse', 'Kesse') !!}
                    </div>
                    <div class="radio-spacing">
                        {!! Form::radio('ruta', 'primaria', old('ruta', $ruta ?? '') === 'primaria', ['id' => 'primaria']) !!}
                        {!! Form::label('primaria', 'Primaria') !!}
                    </div>
                    <div class="radio-spacing">
                        {!! Form::radio('ruta', 'territorial', old('ruta', $ruta ?? '') === 'territorial', ['id' => 'territorial']) !!}
                        {!! Form::label('territorial', 'Territorial') !!}
                    </div>
                    <div class="radio-spacing">
                        {!! Form::radio('ruta', 'intranet', old('ruta', $ruta ?? '') === 'intranet', ['id' => 'intranet']) !!}
                        {!! Form::label('intranet', 'Intranet') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de búsqueda -->
    <div class="form-group">
        {!! Form::button(__('Search'), ['id' => 'searchButton', 'type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}