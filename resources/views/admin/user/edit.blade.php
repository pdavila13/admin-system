<x-admin>
    @section('title')  {{ __('Edit user') }} @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('User data') }}</h3>
            <div class="card-tools"><a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-dark">{{ __('Back') }}</a></div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.update',$user) }}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="name" required
                                    value="{{ $user->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Email" class="form-label">{{ __('Email') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" required value="{{ $user->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>    
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="role" class="form-label">{{ __('Role') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                </div>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="" selected disabled>{{ __('Selecte the role') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $user->roles[0]['name'] === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="float-right">
                            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin>
