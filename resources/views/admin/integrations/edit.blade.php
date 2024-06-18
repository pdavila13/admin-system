<x-admin>
    @section('title')
        {{ __('Integrations') }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Edit element') }}</h3>
                    <div class="card-tools">                
                        <a href="{{route('admin.integration.index')}}" class="btn btn-sm btn-dark">{{ __('Back') }}</a>
                    </div>
                </div>

                {!! Form::model($integration, ['route' => ['admin.integration.update', $integration], 'method' => 'PUT']) !!}
                    <div class="card-body">
                        <div class="card card-info card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-three-electro-tab" data-toggle="pill" href="#custom-tabs-three-electro" role="tab" aria-controls="custom-tabs-three-electro" aria-selected="false">Electromedicina</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-three-sap-tab" data-toggle="pill" href="#custom-tabs-three-sap" role="tab" aria-controls="custom-tabs-three-sap" aria-selected="false">Oficina SAP</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-three-info-tab" data-toggle="pill" href="#custom-tabs-three-info" role="tab" aria-controls="custom-tabs-three-info" aria-selected="false">Informàtica</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabElectro">
                                    <div class="tab-pane fade active show" id="custom-tabs-three-electro" role="tabpanel" aria-labelledby="custom-tabs-three-electro-tab">
                                        <div class="container-fluid">
                                            @include('admin.integrations.partials.form-electro')
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-three-sap" role="tabpanel" aria-labelledby="custom-tabs-three-sap-tab">
                                        <div class="container-fluid">
                                            @include('admin.integrations.partials.form-sap')
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-three-info" role="tabpanel" aria-labelledby="custom-tabs-three-info-tab">
                                        <div class="container-fluid">
                                            @include('admin.integrations.partials.form-info')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" id="submit" class="btn btn-info float-right">{{ __('Save changes') }}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @section('js')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    theme: 'bootstrap4'
                });

                $('#marca').change(function() {
                    var marcaID = $(this).val();
                    if (marcaID) {
                        $.ajax({
                            url: '{{ route("admin.get.models", ":marcaID") }}'.replace(':marcaID', marcaID),
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#modelo').empty().append('<option value="" selected></option>');
                                $.each(data, function(key, value) {
                                    $('#modelo').append('<option value="'+ value.id +'">'+ value.def +'</option>');
                                });
                            }
                        });
                    } else {
                        $('#modelo').empty().append('<option value="" selected></option>');
                    }
                });

                $('#zona').change(function() {
                    var zona = $(this).val();
                    
                    if (zona) {
                        $.ajax({
                            url: '{{ route("admin.get.centers", ":zona") }}'.replace(':zona', zona),
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#centro').empty().append('<option value="" selected></option>');
                                $.each(data, function(key, value) {
                                    $('#centro').append('<option value="'+ value.id +'">'+ value.def +'</option>');
                                });
                            }
                        });
                    } else {
                        $('#centro').empty().append('<option value="" selected></option>');
                    }
                });

                $('#centro').change(function() {
                    var centroId = $(this).val();
                    if (centroId) {
                        $.ajax({
                            url: '{{ route("admin.get.plantas", ":centroId") }}'.replace(':centroId', centroId),
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#ubicacio').empty().append('<option value="" selected></option>');
                                if (data.length > 0) {
                                    $.each(data, function(key, planta) {
                                        $('#ubicacio').append('<option value="' + planta.planta + planta.edifici + '">' + planta.planta + ' ' + planta.edifici + '</option>');
                                    });
                                    $('#ubicacio').prop('disabled', false);
                                } else {
                                    $('#ubicacio').prop('disabled', true);
                                }
                            }
                        });
                    } else {
                        $('#ubicacio').empty().append('<option value="" selected></option>').prop('disabled', true);
                    }
                });

                $(":input").inputmask();
            });
        </script>
    @endsection
</x-admin>