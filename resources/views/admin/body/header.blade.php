<header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30">
        <!-- Sidebar toggle button-->
        <div>
            <ul class="nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu" role="button">
                        <i class="nav-link-icon mdi mdi-menu"></i>
                    </a>
                </li>
                <li class="btn-group nav-item">
                    <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
                        <i class="nav-link-icon mdi mdi-crop-free"></i>
                    </a>
                </li>
                <li class="btn-group nav-item d-none d-xl-inline-block">
                    <a href="{{route('locale', ['lang'=> 'vi'])}}" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="">
                        {{__('VI')}}
                    </a>
                </li>
                <li class="btn-group nav-item d-none d-xl-inline-block">
                    <a href="{{route('locale', ['lang'=> 'en'])}}" class="waves-effect waves-light nav-link rounded svg-bt-icon" title="">
                        {{__('EN')}}
                    </a>

                </li>
            </ul>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <!-- full Screen -->
                <li class="search-bar mr-4">
                    <div class="lookup lookup-circle lookup-right">
                        <input type="text" name="s">
                    </div>
                </li>
                <!-- Notifications -->
                {{-- <li class="dropdown notifications-menu">
                    <a href="#" class="waves-effect waves-light rounded dropdown-toggle" data-toggle="dropdown" title="Notifications">
                        <i class="ti-bell"></i>
                    </a>
                    <ul class="dropdown-menu animated bounceIn">

                        <li class="header">
                            <div class="p-20">
                                <div class="flexbox">
                                    <div>
                                        <h4 class="mb-0 mt-0">Notifications</h4>
                                    </div>
                                    <div>
                                        <a href="#" class="text-danger">Clear All</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="footer">
                            <a href="#">View all</a>
                        </li>
                    </ul>
                </li> --}}

                <!-- User Account-->
                <li class="dropdown user user-menu">
                    <a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0" data-toggle="dropdown" title="User">
                        <img  src="{{ (!empty($user->image))? url('upload/user_images/'.$user->image):url('upload/no_image.jpg') }} " alt="">
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i> {{__('Profile')}}</a>
                            <a class="dropdown-item" href="#"><i class="ti-settings text-muted mr-2"></i> {{__('Setting')}}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="ti-lock text-muted mr-2"></i>{{__('Logout')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light">
                        <i class="ti-settings"></i>
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</header>
                            