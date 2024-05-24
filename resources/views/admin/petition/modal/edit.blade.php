<form class="needs-validation" novalidate action="{{ route('admin.petition.update', $petition->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $petition->id }}">
    <div id="ModalPetitionEdit{{$petition->id}}" class="modal fade text-left" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit petition') }} <b>{{ $petition->petition_number }}</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="company">{{ __('Company') }}</label>
                                <select class="form-control select2 select2-bootstrap4 initialize-select2" name="company_id" id="company" class="form-control">
                                    <option value="" selected disabled>{{ __('Select company') }}</option>
                                    @foreach ($company as $com)
                                        @if ($com->active == 1)
                                            <option {{ $petition->company_id  == $com->id ? 'selected' : '' }} value="{{ $com->id }}">{{ $com->name }}</option>
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
                                <label for="petitionType">{{ __('Petition type') }}</label>
                                <select name="petition_type_id" id="petition_type_id" class="form-control">
                                    <option value="" selected disabled>{{ __('Select petition type') }}</option>
                                    @foreach ($petitionType as $pet_type)
                                        <option {{ $petition->petition_type_id == $pet_type->id ? 'selected' : '' }} value="{{ $pet_type->id }}">{{ $pet_type->name }}</option>
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
                                <input type="text" name="petition_number" id="petition_number" value="{{ $petition->petition_number }}" class="form-control" >
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
                                        <option {{ $petition->user_id == $sys_adm->id ? 'selected' : '' }} value="{{ $sys_adm->id }}">{{ $sys_adm->name }}</option>
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
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="state">{{ __('Status') }}</label>
                                <select name="state_id" id="state_id" class="form-control" >
                                    <option value="" selected disabled>{{ __('Select state') }}</option>
                                    @foreach ($state as $stat)
                                        <option {{ $petition->state_id == $stat->id ? 'selected' : '' }} value="{{ $stat->id }}">{{ $stat->name }}</option>
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
                                <textarea type="text" class="form-control" id="description" name="description" rows="4">{{ $petition->description }}</textarea>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>