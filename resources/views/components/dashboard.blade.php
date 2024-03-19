<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{$user}}</h3>
            <p>{{ __('Users') }}
        </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        <a href="{{ route('admin.user.index') }}" class="small-box-footer">{{ __('View') }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{$company}}</h3>
            <p>{{ __('Companies') }}
        </div>
        <div class="icon">
            <i class="fas fa-building"></i>
        </div>
        <a href="{{ route('admin.company.index') }}" class="small-box-footer">{{ __('View') }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <div class="small-box bg-primary">
        <div class="inner">
            <h3>{{$group_vpn}}</h3>
            <p>{{ __('VPN Groups') }}
        </div>
        <div class="icon">
            <i class="fas fas fa-object-group"></i>
        </div>
        <a href="{{ route('admin.group_vpn.index') }}" class="small-box-footer">{{ __('View') }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <div class="small-box bg-secondary">
        <div class="inner">
            <h3>{{$petition}}</h3>
            <p>{{ __('Petitions') }}
        </div>
        <div class="icon">
            <i class="fas fas fa-list"></i>
        </div>
        <a href="{{ route('admin.petition.index') }}" class="small-box-footer">{{ __('View') }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>