<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    @include('layouts.content.page-alerts')

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">

        <main id="{{ FnView::getUniquePageId() }}" roll="main">
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