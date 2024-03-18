<nav class="main-header navbar navbar-expand navbar-{{ Auth::user()->mode }} navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                <i class="flag-icon flag-icon-es-ca"></i>
            </a>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                <a href="{{ url('locale/ca') }}" class="dropdown-item active">
                    <i class="flag-icon flag-icon-es-ca mr-2"></i> {{ __('Catalonia') }}
                </a>
                <a href="{{ url('locale/es') }}" class="dropdown-item">
                    <i class="flag-icon flag-icon-es mr-2"></i> {{ __('Spanish') }}
                </a>
                <a href="{{ url('locale/gb') }}" class="dropdown-item">
                    <i class="flag-icon flag-icon-gb mr-2"></i> {{ __('English') }}
                </a>
            </div>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input type="submit" name="submit" value="{{ __('Log Out') }}" class="btn btn-primary btn-sm">
                    {{-- <a :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a> --}}
                </form>
        </li>
    </ul>
</nav>
