<header class="main-header">
    <a href="{{route('home')}}" class="logo">
        <span class="logo-mini">{{ config('app.name_mini') }}</span>
        <span class="logo-lg">{{ config('app.name') }}</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" id="sidebar_toggle" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs" style="text-transform: capitalize">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Footer-->
                        <li>
                            <a href="{{ route('password.edit') }}" class=""><i class="fa fa-pencil"></i>Change password</a>
                        </li>
                        <hr class="line">
                        <li>
                            <a class="" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>