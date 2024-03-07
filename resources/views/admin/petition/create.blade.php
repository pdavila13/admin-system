<x-admin>
    @section('title')
        {{ 'Create Petition' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Petition</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.petition.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.petition.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="company">Company</label>
                                        <select name="company_id" id="company" class="form-control" required>
                                            <option value="" selected disabled>Select company</option>
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
                                        <label for="petition_type_id">Petition type</label>
                                        <select name="petition_type_id" id="petition_type_id" class="form-control">
                                            <option value="" selected disabled>Select petition type</option>
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
                                        <label for="petition_number" class="form-label">Petition Number</label>
                                        <input type="text" name="petition_number" id="petition_number" value="{{ old('petition_number') }}" class="form-control" >
                                        @error('petition_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="user_id">Technical system</label>
                                        <select name="user_id" id="user_id" class="form-control" >
                                            <option value="" selected disabled>Select petition type</option>
                                            @foreach ($user as $sys_adm)
                                                <option {{ old('user_id') == $sys_adm->id ? 'selected' : '' }} value="{{ $sys_adm->id }}">{{ $sys_adm->name }}</option>
                                            @endforeach
                                        </select>
                                            @error('user')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date" class="form-label">Date</label>
                                        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" value="{{ old('date') }}">
                                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <!--<input type="text" name="date" id="date" value="{{ old('date') }}" class="form-control" required>-->
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="state_id">Status</label>
                                        <select name="state_id" id="state_id" class="form-control" >
                                            <option value="" selected disabled>Select state</option>
                                            @foreach ($state as $stat)
                                                <option {{ old('state_id') == $stat->id ? 'selected' : '' }} value="{{ $stat->id }}">{{ $stat->name }}</option>
                                            @endforeach
                                        </select>
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $(function () {
                $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
            });
        </script>
    @endsection
</x-admin>
