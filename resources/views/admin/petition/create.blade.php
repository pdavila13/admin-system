<x-admin>
    @section('title')
        {{ __('Create petition') }}
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
                    <form class="needs-validation" novalidate action="{{ route('admin.petition.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="company">{{ __('Company') }}</label>
                                        <select class="form-control select2 select2-bootstrap4" name="company_id" id="company" required>
                                            <option value="" selected disabled>{{ __('Select company') }}</option>
                                            @foreach ($company as $com)
                                                <option {{ old('company_id') == $com->id ? 'selected' : '' }} value="{{ $com->id }}">{{ $com->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('company_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="petition_type_id">{{ __('Petition type') }}</label>
                                        <select name="petition_type_id" id="petition_type_id" class="form-control">
                                            <option value="" selected disabled>{{ __('Select petition type') }}</option>
                                            @foreach ($petitionType as $pet_type)
                                                <option {{ old('petition_type_id') == $pet_type->id ? 'selected' : '' }} value="{{ $pet_type->id }}">{{ $pet_type->name }}</option>
                                            @endforeach
                                        </select>
                                            @error('petition_type_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="petition_number" class="form-label">{{ __('Petition number') }}</label>
                                        <input type="text" name="petition_number" id="petition_number" value="{{ old('petition_number') }}" class="form-control" >
                                        @error('petition_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="user_id">{{ __('Technical system') }}</label>
                                        <select name="user_id" id="user_id" class="form-control" >
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        </select>
                                            @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="datepicker" class="form-label">{{ __('Date') }}</label>
                                        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                            <input type="text" name="datepicker" id="datepicker" class="form-control datetimepicker-input" data-target="#datetimepicker4" value="{{ old('datepicker') ?? $currentDate }}">
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
                                        <label for="state_id">{{ __('Status') }}</label>
                                        <select name="state_id" id="state_id" class="form-control" >
                                            <option value="" selected disabled>{{ __('Select state') }}</option>
                                            @foreach ($state as $stat)
                                                <option {{ old('state_id') == $stat->id ? 'selected' : '' }} value="{{ $stat->id }}">{{ $stat->name }}</option>
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
                                        <textarea type="text" class="form-control" id="description" name="description"
                                            placeholder="" rows="4">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $(document).ready(function() {
                var currentDate = moment().format('DD-MM-YYYY');
                $('#datepicker').val(currentDate);

                $('#datetimepicker4').datetimepicker({
                    format: 'DD-MM-YYYY'
                });

                $('.select2').select2({
                    theme: 'bootstrap4'
                });
            });
        </script>
    @endsection
</x-admin>