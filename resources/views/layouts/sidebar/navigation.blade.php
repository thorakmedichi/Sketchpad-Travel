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
                         <li>
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span class="menu-title">
                                    <strong>Main</strong>
                                </span>
                                <i class="arrow"></i>
                            </a>
                            <!--Submenu-->
                            <ul class="collapse in">
                                <li><a href="#">Sub</a></li>
                                <li class="list-divider"></li>
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