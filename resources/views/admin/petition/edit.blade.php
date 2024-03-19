<x-admin>
    @section('title')
        {{ __('Edit petition') }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Petition data') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.petition.index') }}" class="btn btn-info btn-sm">{{ __('Back') }}</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.petition.update', $data) }}" 
                        method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="edit_id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="row">
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
                                        <label for="petitionType">{{ __('Petition type') }}</label>
                                        <select name="petition_type_id" id="petition_type_id" class="form-control">
                                            <option value="" selected disabled>{{ __('Select petition type') }}</option>
                                            @foreach ($petitionType as $pet_type)
                                                <option {{ $data->petition_type_id == $pet_type->id ? 'selected' : '' }} value="{{ $pet_type->id }}">{{ $pet_type->name }}</option>
                                            @endforeach
                                        </select>
                                            @error('petitionType')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="petition_number" class="form-label">{{ __('Petition number') }}</label>
                                        <input type="text" name="petition_number" id="petition_number" value="{{ $data->petition_number }}" class="form-control" >
                                        @error('petition_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="user">{{ __('Technical system') }}</label>
                                        <select name="user_id" id="user_id" class="form-control" >
                                            <option value="" selected disabled>{{ __('Select petition type') }}</option>
                                            @foreach ($users as $sys_adm)
                                                <option {{ $data->user_id == $sys_adm->id ? 'selected' : '' }} value="{{ $sys_adm->id }}">{{ $sys_adm->name }}</option>
                                            @endforeach
                                        </select>
                                            @error('user')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="datepicker" class="form-label">{{ __('Date') }}</label>
                                        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                            <input type="text" name="datepicker" id="datepicker" class="form-control datetimepicker-input" data-target="#datetimepicker4" 
                                            value="{{ DateTime::createFromFormat('Y-m-d H:i:s', $data->datepicker)->format('d-m-Y') }}">
                                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @error('datepicker')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="state">{{ __('Status') }}</label>
                                        <select name="state_id" id="state_id" class="form-control" >
                                            <option value="" selected disabled>{{ __('Select state') }}</option>
                                            @foreach ($state as $stat)
                                                <option {{ $data->state_id == $stat->id ? 'selected' : '' }} value="{{ $stat->id }}">{{ $stat->name }}</option>
                                            @endforeach
                                        </select>
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="description">{{ __('Description') }}</label>
                                        <textarea type="text" class="form-control" id="description" name="description" rows="4">{{ $data->description }}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $(document).ready(function() {
                $('#datetimepicker4').datetimepicker({
                    format: 'DD-MM-YYYY',
                    defaultDate: new Date(),
                });
            });
        </script>
    @endsection
</x-admin>
