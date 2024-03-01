<x-admin>
    @section('title')
        {{ 'Create vpn3e' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create vpn3e</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.group_vpn.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.group_vpn.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="form-control" required>
                                        @error('name')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="company">Company</label>
                                        <select name="company" id="company" class="form-control" required>
                                            <option value="" selected disabled>Select company</option>
                                            @foreach ($company as $com)
                                                <option {{ old($com->id) == $com->id ? 'selected' : '' }}
                                                    value="{{ $com->id }}">{{ $com->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('company')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="network" class="form-label">Network</label>
                                        <input type="network" class="form-control" name="network" required
                                            value="{{ old('network') }}">
                                        @error('network')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="description" class="form-control" name="description" required
                                            value="{{ old('description') }}">
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submit" class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            $("#company").on('change', function() {
                let company = $("#company").val();
                $("#submit").attr('disabled', 'disabled');
                $("#submit").html('Please wait');
                $.ajax({
                    url: "{{ route('admin.getsubcategory') }}",
                    type: 'GET',
                    data: {
                        company: company,
                    },
                    success: function(data) {
                        if (data) {
                            $("#submit").removeAttr('disabled', 'disabled');
                            $("#submit").html('Save');
                            $("#subcompany").html(data);
                        }
                    }
                });
            });
        </script>
    @endsection
</x-admin>
