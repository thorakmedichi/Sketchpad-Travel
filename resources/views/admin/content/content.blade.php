<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    @include('admin.content.page-alerts')

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">

        <main id="{{ Route::currentRouteName() }}" roll="main">
            <div class="content">
                @yield('content')
            </div>
        </main>
    
    </div>
    <!--===================================================-->
    <!--End page content-->


</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->