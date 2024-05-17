<form action="{{ route('admin.group_vpn.destroy', encrypt($group_vpn->id)) }}" method="POST" enctype="multipart/form-data">
    @method('DELETE')
    @csrf
    <div class="modal fade" id="ModalGroupVPNDelete{{ $group_vpn->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Group VPN Disable') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>   
                <div class="modal-body">You sure you want to disable <b>{{ $group_vpn->name }}</b>?</div>
                <div class="modal-footer">
                    <button type="button" class="btn gray btn-outline-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-outline-danger">{{ __('Disable') }}</button>
                </div>
            </div>
        </div>
    </div>   
</form>