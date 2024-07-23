@extends('layouts.app')

@section('subtitle', __('Inventory'))
@section('content_header_title', __('Manage Trademark and Model'))

@section('content_body')
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.marca-model.store', 'method' => 'POST']) !!}
                    <table class="table table-striped" cellspacing="0" style="width:100%">
                        <thead>
                            <tr>
                                <td>{{ mb_strtoupper(__('Type')) }}</td>
                                <td>{{ mb_strtoupper(__('Trademark')) }}</td>
                                <td>{{ mb_strtoupper(__('Model')) }}</td>
                                <td>{{ mb_strtoupper(__('Description')) }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="18%">
                                    {!! Form::select('tipo', $tipos->pluck('def','id')->toArray(), old('def'), ['class' => 'form-control select2 select2-bootstrap4 ', 'required' => 'required', 'placeholder' => __('Select', ['name' => __('Type')]), 'id' => 'tipo', 'onchange' => 'cargaMarcas(this.value, "marca", "nou");']) !!}
                                    @error('tipo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td width="25%">
                                    {!! Form::select('marca', [], old('DEF'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required', 'id' => 'marca', 'onchange' => 'cargaModelos(this.value, "modelo", "nou");']) !!}
                                </td>
                                <td width="25%">
                                    {!! Form::select('modelo', [], old('def'), ['class' => 'form-control select2 select2-bootstrap4', 'required' => 'required', 'id' => 'modelo']) !!}
                                </td>
                                <td>
                                    {!! Form::text('description', old('def'), ['class' => 'form-control', 'required' => 'required', 'id' => 'description']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer float-end float-right">
                    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary float-end float-right']) !!}
                </div>
            </div>
            {!! Form::close() !!}     
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            const selectPlaceholderMarca = @json(__('Select', ['name' => __('Trademark')]));
            const selectPlaceholderModel = @json(__('Select', ['name' => __('Model')]));
            const addNewTextMarca = @json(mb_strtoupper(__('Add new', ['name' => __('Trademark')])));
            const addNewTextModel = @json(mb_strtoupper(__('Add new', ['name' => __('Model')])));

            window.cargaMarcas = function(tipoId) {
                fetch(`/admin/get-marcas?tipo_id=${tipoId}`).then(response => response.json()).then(data => {
                    let marcaSelect = document.getElementById('marca');
                    marcaSelect.innerHTML = `<option value="">${selectPlaceholderMarca}</option>`;
                    data.forEach(marca => {
                        let option = document.createElement('option');
                        option.value = marca.ID;
                        option.text = marca.DEF;
                        marcaSelect.appendChild(option);
                    });
                    // Add option for new brand
                    let option = document.createElement('option');
                    option.value = '-2';
                    option.text = `** ${addNewTextMarca} **`;
                    marcaSelect.appendChild(option);
                });
            }

            window.cargaModelos = function(marcaId) {
                if (marcaId == '-2') {
                    alertNuevaMarca();
                    document.getElementById('modelo').disabled = true;
                } else {
                    fetch(`/admin/get-modelos?marca_id=${marcaId}`).then(response => response.json()).then(data => {
                        let modeloSelect = document.getElementById('modelo');
                        modeloSelect.innerHTML = `<option value="">${selectPlaceholderModel}</option>`;
                        data.forEach(modelo => {
                            let option = document.createElement('option');
                            option.value = modelo.id;
                            option.text = modelo.def;
                            modeloSelect.appendChild(option);
                        });
                        // Add option for new model
                        let option = document.createElement('option');
                        option.value = '-2';
                        option.text = `** ${addNewTextModel} **`;
                        modeloSelect.appendChild(option);
                    });
                }
            }

            window.alertNuevaMarca = function() {
                Swal.fire({
                    title: 'Nova marca',
                    text: 'Segur que vols afegir una nova marca?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Acceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Disable select de modelo
                        document.getElementById('modelo').disabled = true; 
                    } else {
                        // If not confirmed, reset select de marca
                        document.getElementById('modelo').disabled = false;
                    }
                });
            }

            // Add event listeners
            document.getElementById('tipo').addEventListener('change', function() {
                cargaMarcas(this.value);
            });

            document.getElementById('marca').addEventListener('change', function() {
                cargaModelos(this.value);
            });
        });
    </script>
@endpush