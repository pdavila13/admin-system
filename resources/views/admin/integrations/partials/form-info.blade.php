<div class="row justify-content-center">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Network infomation</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            {!! Form::label('network', 'Network') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-network-wired"></i></span>
                                </div>
                                {!! Form::text('network', $dataFromFacadeIP->where('id', $integration->id)->first()->centro_ip ?? '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                {!! Form::label('ip_address', 'IP Address') !!}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                    </div>
                                    {!! Form::select('ip_address', $dataFromFacadeIP->where('id', $integration->id)->pluck('ip', 'id')->toArray(), old('ip_address'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required']) !!}
                                </div>
                            </div>
                            @error('ip_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            {!! Form::label('gateway', 'Gateway') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                                </div>
                                {!! Form::text('gateway', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('netmask', 'Netmask') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-mask"></i></span>
                                </div>
                                {!! Form::text('netmask', $dataFromFacadeIP->where('id', $integration->id)->first()->centro_mask ?? '', ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            {!! Form::label('switch_port', 'Switch port') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-ethernet"></i></span>
                                </div>
                                {!! Form::text('switch_port', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('point', 'Point') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map"></i></span>
                                </div>
                                {!! Form::text('point', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Evolution infomation</h3>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('aet', __('AET')) !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                {!! Form::text('aet', old('aet'), ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                            @error('aet')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>