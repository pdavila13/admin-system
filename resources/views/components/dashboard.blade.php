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
    <div class="small-box bg-secondary">
        <div class="inner">
            <h3>50</h3>
            <p>{{ __('Device type') }}
        </div>
        <div class="icon">
            <i class="fas fa-x-ray"></i>
        </div>
        <a href="{{ route('admin.inventary.index') }}" class="small-box-footer">{{ __('View') }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <div class="small-box bg-primary">
        <div class="inner">
            <h3>{{$center}}</h3>
            <p>{{ __('Centers') }}
        </div>
        <div class="icon">
            <i class="fas fas fa-hospital"></i>
        </div>
        <a href="{{ route('admin.inventary.index') }}" class="small-box-footer">{{ __('View') }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{$element}}</h3>
            <p>{{ __('Elements') }}
        </div>
        <div class="icon">
            <i class="fas fas fa-laptop-medical"></i>
        </div>
        <a href="{{ route('admin.inventary.index') }}" class="small-box-footer">{{ __('View') }} <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>