<form class="needs-validation" novalidate action="{{ route('admin.group_vpn.update', $group_vpn->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $group_vpn->id }}">
    <div id="ModalGroupVPNEdit{{$group_vpn->id}}" class="modal fade text-left" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit group VPN') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $group_vpn->name }}">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="company">{{ __('Company') }}</label>
                                <select class="form-control select2 select2-bootstrap4 initialize-select2" name="company_id" id="company" class="form-control">
                                    <option value="" selected disabled>{{ __('Select company') }}</option>
                                    @foreach ($company as $com)
                                        @if ($com->active == 1)
                                            <option {{ $group_vpn->company_id  == $com->id ? 'selected' : '' }} value="{{ $com->id }}">{{ $com->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <!-- Campo oculto para enviar el valor de company_id -->
                                <input type="hidden" name="company_id" value="{{ $group_vpn->company_id }}">
                            </div>
                            @error('company_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>    

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="network" class="form-label">{{ __('Network') }}</label>
                                <input type="text" class="form-control" name="network" required value="{{ $group_vpn->network }}">
                            </div>
                            @error('network')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea type="text" class="form-control" id="description" name="description">{{ $group_vpn->description }}</textarea>
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