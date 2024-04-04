<x-admin>
    @section('title'){{ __('Create permission') }} @endsection
    <section class="content">
        <!-- Default box -->
        <div class="d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Create New Permission') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.permission.index') }}"
                                class="btn btn-sm btn-dark">{{ __('Back') }}</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.permission.store') }}" method="POST"
                        class="needs-validation" novalidate="">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">{{__('Name') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-hat-cowboy"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="name" id="name"
                                                required="" value="{{ old('name') }}">
                                            @error('name')
                                                <span>{{ $message }}</span>
                                            @enderror
                                            <div class="invalid-feedback">{{ __('Permission name field is required.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer float-end float-right">
                            <button type="submit" id="submit"
                                class="btn btn-primary float-end float-right">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card -->

    </section>
</x-admin>
