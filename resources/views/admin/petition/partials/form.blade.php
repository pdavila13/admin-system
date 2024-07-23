<div class="row">                        
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('company_id', __('Company')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                </div>
                {!! Form::select('company_id', $company->pluck('name', 'id'), old('company_id'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required', 'placeholder' => __('Select company')]) !!}
            </div>
        </div>
        @error ('company_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('petition_type_id', __('Petition type')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                </div>
                {!! Form::select('petition_type_id', $petitionType->pluck('name', 'id'), old('petition_type_id'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required', 'placeholder' => __('Select petition type')]) !!}
            </div>
        </div>
        @error ('petition_type_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
            
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('petition_number', __('Petition number')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                </div>
                {!! Form::text('petition_number', old('petition_number'), ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
        @error ('petition_number')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('user_id', __('Technical system')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                {!! Form::select('user_id', $users->pluck('name', 'id'), old('user_id'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
            </div>
        </div>
        @error ('user_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
           
    </div>

    <div class="col-lg-6">
        {!! Form::label('datepicker', __('Date'), ['class' => 'form-label']) !!}
        <div class="input-group date datetimepicker" data-target-input="nearest">
            <div class="input-group-append" data-target=".datetimepicker" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
            {!! Form::text('datepicker', isset($petition) && $petition->datepicker ? DateTime::createFromFormat('Y-m-d H:i:s', $petition->datepicker)->format('d-m-Y') : null, ['class' => 'form-control datetimepicker-input', 'data-target' => '.datetimepicker']) !!}
        </div>
        @error('datepicker')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('state_id', __('Status')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                </div>
                {!! Form::select('state_id', $state->pluck('name', 'id'), old('state_id'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required', 'placeholder' => __('Select state')]) !!}
            </div>
        </div>
        @error ('state_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('description', __('Description')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                </div>
                {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'rows' => 4, 'required' => 'required', 'placeholder' => __('Description')]) !!}
            </div>
        </div>                            
    </div>
    @error('description')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>