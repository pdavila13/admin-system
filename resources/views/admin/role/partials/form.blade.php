<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('name', __('Name')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hat-cowboy"></i></span>
                </div>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('description', __('Description')) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                </div>
                {!! Form::text('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
            @error('description')
                <span>{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<br>
<h5 class="text-muted">{{ __('List permissions') }}</h5>
<div class="row">
    @foreach ($permissions->chunk(ceil($permissions->count() / 3)) as $chunkedPermissions)
        <div class="col-lg-4">
            <div class="form-group">
                @foreach ($chunkedPermissions as $permission)
                    <div class="form-check mb-3">
                        {{-- {!! Form::checkbox('permission[]', $permission->id, $role->permissions->contains($permission->id), ['class' => 'form-check-input', 'id' => 'permission_' . $permission->id]) !!} --}}
                        {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'form-check-input', 'id' => 'permissions_' . $permission->id]) !!}
                        {!! Form::label('permissions_' . $permission->id, $permission->description, ['class' => 'form-check-label']) !!}
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>   