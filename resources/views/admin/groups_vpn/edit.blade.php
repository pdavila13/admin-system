<x-admin>
    @section('title')
        {{ __('Edit group VPN') }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('VPN group data') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.group_vpn.index') }}" class="btn btn-info btn-sm">{{ __('Back') }}</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.group_vpn.update',$data) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="company">{{ __('Company') }}</label>
                                        <select name="company_id" id="company" class="form-control" readonly>
                                            <option value="" selected disabled>{{ __('Select company') }}</option>
                                            @foreach ($company as $com)
                                                <option {{ $data->company_id  == $com->id ? 'selected' : '' }} value="{{ $com->id }}">{{ $com->name }}</option>
                                            @endforeach
                                        </select>
                                        <!-- Campo oculto para enviar el valor de company_id -->
                                        <input type="hidden" name="company_id" value="{{ $data->company_id }}">
                                        @error('company_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>                                                     
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="network" class="form-label">{{ __('Network') }}</label>
                                        <input type="network" class="form-control" name="network" required
                                            value="{{ $data->network }}">
                                        @error('network')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="description" class="form-label">{{ __('Description') }}</label>
                                        <input type="description" class="form-control" name="description" required
                                            value="{{ $data->description }}">
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>
