<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Applications') }}</h3>
        </div>
        <div class="card-body">
            <a href="{{ env('INVENTARY_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-barcode"></i> {{ __('Inventory') }}
            </a>
            <a href="{{ env('PHONE_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-phone"></i> {{ __('Phones') }}
            </a>
            <a href="{{ env('ORACLE_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-th"></i> {{ __('Oracle Tablespaces') }}
            </a>
            <a href="{{ env('CHECKMK_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-check"></i> {{ __('Check MK') }}
            </a>
            <a href="{{ env('VCENTER_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-unlock"></i> {{ __('vCenter') }}
            </a>
            <a href="{{ env('VCENTER_MGMT_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-lock"></i> {{ __('vCenter MGMT') }}
            </a>
            <a href="{{ env('RACKTABLES_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-table"></i> {{ __('Racktables') }}
            </a>
            <a href="{{ env('SCMI_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-thermometer-empty"></i> {{ __('SCMI CPD-3C') }}
            </a>
            <a href="{{ env('NETAPP_3C_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-database"></i> {{ __('NETAPP 3C') }}
            </a>
            <a href="{{ env('NETAPP_SH_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-database"></i> {{ __('NETAPP SH') }}
            </a>
            <a href="{{ env('HPE_IRS_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-server"></i> {{ __('HPE IRS') }}
            </a>
            <a href="{{ env('SIMDCAT_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-cloud"></i> {{ __('SIMDCAT') }}
            </a>
            <a href="{{ env('PACS_URL') }}" class="btn btn-app" target="_blank">
                <i class="fas fa-paper-plane"></i> {{ __('PACS') }}
            </a>
        </div>
    </div>
</div>