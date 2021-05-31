<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @hasPermission('users.index')
            <li class="">
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-user"></i>
                    <span>User</span>
                </a>
            </li>
            @endhasPermission
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>