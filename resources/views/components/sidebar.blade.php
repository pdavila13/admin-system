<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i> Users
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.role.index') }}" class="nav-link {{ Route::is('admin.role.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-tag"></i> Roles
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.permission.index') }}" class="nav-link {{ Route::is('admin.permission.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-hat-cowboy"></i> Permissions
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.company.index') }}" class="nav-link {{ Route::is('admin.company.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i> Companies
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.group_vpn.index') }}" class="nav-link {{ Route::is('admin.group_vpn.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list-alt"></i> Grups VPN
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.petition.index') }}" class="nav-link {{ Route::is('admin.petition.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-list"></i> Petitions
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}">
                <i class="nav-icon fas fa-id-card"></i> Profile
            </a>
        </li>
    </ul>
</nav>
