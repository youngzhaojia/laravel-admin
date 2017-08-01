<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('admin.index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>B</b>ask</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>Bask</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ asset('images/young.jpg') }}" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::guard('admin')->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset('images/young.jpg') }}" class="img-circle" alt="User Image">

                            <p>
                                {{ Auth::guard('admin')->user()->name }} - Web Developer
                                <small>Member since {{ substr(Auth::guard('admin')->user()->created_at,0,10) }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            {{--<div class="row">--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">Followers</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">Sales</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">Friends</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">个人资料</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">退出</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
