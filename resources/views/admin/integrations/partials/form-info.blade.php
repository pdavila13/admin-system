<div class="row justify-content-center">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Network information') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            {!! Form::label('network', __('Network')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-network-wired"></i></span>
                                </div>
                                {!! Form::text('network', $dataFromFacadeIP->centro_ip, ['class' => 'form-control', 'readonly' => 'readonly']) !!}

                                {{-- {!! Form::text('network', $dataFromFacadeIP->where('id', $integration->id)->first()->centro_ip ?? '', ['class' => 'form-control', 'readonly' => 'readonly']) !!} --}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                {!! Form::label('ip_address', __('IP Address')) !!}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                    </div>

                                    {!! Form::select('ip_address', $ipOptions, old('ip_address', $dataFromFacadeIP->ip ?? null), $selectAttributes) !!}
                                </div>
                            </div>
                            @error('ip_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            {!! Form::label('gateway', __('Gateway')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                                </div>
                                {!! Form::text('gateway', $gateway, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('netmask', __('Network mask')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-mask"></i></span>
                                </div>
                                {!! Form::text('netmask', $dataFromFacadeIP->centro_mask, ['class' => 'form-control', 'readonly' => 'readonly']) !!}

                                {{-- {!! Form::text('netmask', $dataFromFacadeIP->where('id', $integration->id)->first()->centro_mask ?? '', ['class' => 'form-control', 'readonly' => 'readonly']) !!} --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            {!! Form::label('switch', __('Switch port')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-ethernet"></i></span>
                                </div>
                                {!! Form::text('switch', null, ['class' => 'form-control']) !!}
                            </div>
                            @error('switch')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::label('roseta', __('Point')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-thumbtack"></i></span>
                                </div>
                                {!! Form::text('roseta', null, ['class' => 'form-control']) !!}
                            </div>
                            @error('roseta')
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
                <h3 class="card-title">{{ __('Evolutionary information') }}</h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('aet', __('AETITLE')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                {!! Form::text('aet', old('aet'), ['class' => 'form-control']) !!}
                            </div>
                            @error('aet')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::label('codi_evolutiu', __('Evolutive code')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                </div>
                                {!! Form::text('codi_evolutiu', old('codi_evolutiu'), ['class' => 'form-control']) !!}
                            </div>
                            @error('codi_evolutiu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>