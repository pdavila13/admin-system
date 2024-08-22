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
        {!! Form::submit(__('Search'), ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}


{{-- {!! Form::open(['route' => 'admin.catalog.search', 'method' => 'POST']) !!}
    <div class="row">
        <!-- Radio checkbox -->
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('ruta', 'Elegir ruta') !!}
                <div>
                    {!! Form::radio('ruta', 'kesse', old('ruta', $ruta ?? '') === 'kesse', ['id' => 'kesse', 'class' => 'radio-spacing']) !!}
                    {!! Form::label('kesse', 'Kesse') !!}
                    {!! Form::radio('ruta', 'primaria', old('ruta', $ruta ?? '') === 'primaria', ['id' => 'primaria', 'class' => 'radio-spacing']) !!}
                    {!! Form::label('primaria', 'Primaria') !!}
                    {!! Form::radio('ruta', 'territorial', old('ruta', $ruta ?? '') === 'territorial', ['id' => 'territorial', 'class' => 'radio-spacing']) !!}
                    {!! Form::label('territorial', 'Territorial') !!}
                    {!! Form::radio('ruta', 'intranet', old('ruta', $ruta ?? '') === 'intranet', ['id' => 'intranet', 'class' => 'radio-spacing']) !!}
                    {!! Form::label('intranet', 'Intranet') !!}
                </div>
            </div>
        </div>

        <!-- Checkbox Última versión -->
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::checkbox('latest_version', 'on', null, ['id' => 'latest_version']) !!}
                {!! Form::label('latest_version', 'Última versión') !!}
            </div>
        </div>
    
        <!-- Columna para el campo de búsqueda -->
        <div class="col-md-6">
            <div class="form-group d-flex align-items-lg-start h-100">
                <div class="input-group input-group-lg">
                    {!! Form::text('keywords', '', ['class' => 'form-control form-control-lg', 'placeholder' => 'Type your keywords here']) !!}
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!} --}}