<!--NAVBAR-->
<!--===================================================-->
<header id="navbar">
	<div id="navbar-container" class="boxed">

		<!--Brand logo & name-->
		<!--================================-->
		<div class="navbar-header">
			<a href="{{ url('/') }}" class="navbar-brand">
				<img src="{{ url('img/logo.png') }}" height="32" width="32" alt="{{ Config::get('brand.admin_brand') }} Logo" class="brand-icon">
				<div class="brand-title">
					<span class="brand-text">{{ Config::get('brand.admin_brand') }}</span>
				</div>
			</a>
		</div>
		<!--================================-->
		<!--End brand logo & name-->

		<!--Header Navbar-->
		<!--================================-->
		<div class="navbar-content clearfix">

			@if (Auth::check())
			<ul class="nav navbar-top-links pull-left">
				<!--Navigation toogle button-->
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<li class="tgl-menu-btn">
					<a class="mainnav-toggle" href="#">
						<i class="fa fa-navicon fa-lg"></i>
					</a>
				</li>
				<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
				<!--End Navigation toogle button-->
			</ul>

			@endif

			<ul class="nav navbar-top-links pull-right">
				<!-- Authentication Links -->
				@if (!Auth::check())
					<li><a href="{{ url('/login') }}">Login</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>

		</div>
		<!--================================-->
		<!--End Header Navbar-->

	</div>
</header>

<!--===================================================-->
<!--END NAVBAR-->