<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$user}}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('admin.user.index') }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$company}}</h3>
                <p>Total Companies</p>
            </div>
            <div class="icon">
                <i class="fas fa-building"></i>
            </div>
            <a href="{{ route('admin.company.index') }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{$group_vpn}}</h3>
                <p>Total Groups VPN</p>
            </div>
            <div class="icon">
                <i class="fas fas fa-object-group"></i>
            </div>
            <a href="{{ route('admin.group_vpn.index') }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{$petition}}</h3>
                <p>Total Petitions</p>
            </div>
            <div class="icon">
                <i class="fas fas fa-list"></i>
            </div>
            <a href="{{ route('admin.petition.index') }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Latest Petitions</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>