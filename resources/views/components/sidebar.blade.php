<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>{{ __('Dashboard') }}</p>
            </a>
        </li>
        <li class="nav-header">{{ __('MANAGEMENT') }}</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    {{ __('General') }}
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>{{ __('Users') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.role.index') }}" class="nav-link {{ Route::is('admin.role.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>{{ __('Roles') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.permission.index') }}" class="nav-link {{ Route::is('admin.permission.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hat-cowboy"></i>
                        <p>{{ __('Permissions') }}</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-desktop"></i>
                <p>
                    {{ __('Systems') }}
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.company.index') }}" class="nav-link {{ Route::is('admin.company.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>{{ __('Companies') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.group_vpn.index') }}" class="nav-link {{ Route::is('admin.group_vpn.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-object-group"></i>
                        <p>{{ __('VPN Groups') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.petition.index') }}" class="nav-link {{ Route::is('admin.petition.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>{{ __('Petitions') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-header">{{ __('SETTING ACCOUNT') }}</li>
        <li class="nav-item">
            <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}">
                <i class="nav-icon fas fa-id-card"></i>
                <p>{{ __('Profile') }}</p>
            </a>
        </li>
    </ul>
</nav>