<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
    <div id="mainnav">

        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <ul id="mainnav-menu" class="list-group">
            
                        <!--Category name-->
                        <li class="list-header">Navigation</li>
            
                        <!--Menu list item-->
                        <li>
                            <a href="{{ url('/') }}">
                                <i class="fa fa-dashboard"></i>
                                <span class="menu-title">
                                    <strong>Dashboard</strong>
                                    <span class="label label-success pull-right">Top</span>
                                </span>
                            </a>
                        </li>

                        <!--Menu list item-->
                        <!-- Authors -->
                        <li>
                            <a href="{{ route('admin.authors.index') }}">
                                <i class="fa fa-user"></i>
                                <span class="menu-title">
                                    <strong>Authors</strong>
                                </span>
                                <i class="arrow"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse in">
                                <li>
                                    <a href="{{ route('admin.authors.index') }}">
                                        <i class="fa fa-eye"></i>
                                        <span class="menu-title">
                                            <strong>View all</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.authors.create') }}">
                                        <i class="fa fa-pencil"></i>
                                        <span class="menu-title">
                                            <strong>Create</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <!-- Locations -->
                        <li>
                            <a href="{{ route('admin.locations.index') }}">
                                <i class="fa fa-map-marker"></i>
                                <span class="menu-title">
                                    <strong>Locations</strong>
                                </span>
                                <i class="arrow"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse in">
                                <li>
                                    <a href="{{ route('admin.locations.index') }}">
                                        <i class="fa fa-eye"></i>
                                        <span class="menu-title">
                                            <strong>View all</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.locations.create') }}">
                                        <i class="fa fa-pencil"></i>
                                        <span class="menu-title">
                                            <strong>Create</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Trips -->
                        <li>
                            <a href="{{ route('admin.trips.index') }}">
                                <i class="fa fa-plane"></i>
                                <span class="menu-title">
                                    <strong>Trips</strong>
                                </span>
                                <i class="arrow"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse in">
                                <li>
                                    <a href="{{ route('admin.trips.index') }}">
                                        <i class="fa fa-eye"></i>
                                        <span class="menu-title">
                                            <strong>View all</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.trips.create') }}">
                                        <i class="fa fa-pencil"></i>
                                        <span class="menu-title">
                                            <strong>Create</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Blogs -->
                        <li>
                            <a href="{{ route('admin.blogs.index') }}">
                                <i class="fa fa-th-large"></i>
                                <span class="menu-title">
                                    <strong>Blogs</strong>
                                </span>
                                <i class="arrow"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse in">
                                <li>
                                    <a href="{{ route('admin.blogs.index') }}">
                                        <i class="fa fa-eye"></i>
                                        <span class="menu-title">
                                            <strong>View all</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.blogs.create') }}">
                                        <i class="fa fa-pencil"></i>
                                        <span class="menu-title">
                                            <strong>Create</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Maps -->
                        <li>
                            <a href="{{ route('admin.maps.index') }}">
                                <i class="fa fa-map"></i>
                                <span class="menu-title">
                                    <strong>Maps</strong>
                                </span>
                                <i class="arrow"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse in">
                                <li>
                                    <a href="{{ route('admin.maps.index') }}">
                                        <i class="fa fa-eye"></i>
                                        <span class="menu-title">
                                            <strong>View all</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.maps.create') }}">
                                        <i class="fa fa-pencil"></i>
                                        <span class="menu-title">
                                            <strong>Create</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Images -->
                        <li>
                            <a href="{{ route('admin.images.index') }}">
                                <i class="fa fa-picture-o"></i>
                                <span class="menu-title">
                                    <strong>Images</strong>
                                </span>
                                <i class="arrow"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse in">
                                <li>
                                    <a href="{{ route('admin.images.index') }}">
                                        <i class="fa fa-eye"></i>
                                        <span class="menu-title">
                                            <strong>View all</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.images.create') }}">
                                        <i class="fa fa-pencil"></i>
                                        <span class="menu-title">
                                            <strong>Create</strong>
                                        </span>
                                        <i class="arrow"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
<!--===================================================-->
<!--END MAIN NAVIGATION-->