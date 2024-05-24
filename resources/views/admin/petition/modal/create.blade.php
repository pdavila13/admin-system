<form class="needs-validation" novalidate action="{{ route('admin.petition.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="ModalPetitionCreate" class="modal fade text-left" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Create new petition') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row">                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="company">{{ __('Company') }}</label>
                                <select class="form-control select2 select2-bootstrap4" name="company_id" id="companySelect2" required>
                                    <option value="" selected>{{ __('Select company') }}</option>
                                    @foreach ($company as $com)
                                        @if ($com->active == 1)
                                            <option {{ old('company_id') == $com->id ? 'selected' : '' }} value="{{ $com->id }}">{{ $com->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('company_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="petition_type_id">{{ __('Petition type') }}</label>
                                <select name="petition_type_id" id="petition_type_id" class="form-control" required>
                                    <option value="" selected disabled>{{ __('Select petition type') }}</option>
                                    @foreach ($petitionType as $pet_type)
                                        <option {{ old('petition_type_id') == $pet_type->id ? 'selected' : '' }} value="{{ $pet_type->id }}">{{ $pet_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('petition_type_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="petition_number" class="form-label">{{ __('Petition number') }}</label>
                                <input type="text" name="petition_number" id="petition_number" value="{{ old('petition_number') }}" class="form-control" required>
                            </div>
                            @error('petition_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="user_id">{{ __('Technical system') }}</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label for="datepicker" class="form-label">{{ __('Date') }}</label>
                            <div class="input-group date datetimepicker" data-target-input="nearest">
                                <input type="text" name="datepicker" class="form-control datetimepicker-input" data-target=".datetimepicker" 
                                value="{{ DateTime::createFromFormat('Y-m-d H:i:s', $petition->datepicker)->format('d-m-Y') }}">
                                <div class="input-group-append" data-target=".datetimepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @error('datepicker')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="state_id">{{ __('Status') }}</label>
                                <select name="state_id" id="state_id" class="form-control" required>
                                    <option value="" selected disabled>{{ __('Select state') }}</option>
                                    @foreach ($state as $stat)
                                        <option {{ old('state_id') == $stat->id ? 'selected' : '' }} value="{{ $stat->id }}">{{ $stat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('state')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea type="text" class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            </div>                            
                        </div>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>