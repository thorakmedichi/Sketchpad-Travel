<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html lang="en" class="no-js gt-ie8"> <![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <title>{{ Config::get('brand.admin_brand')  }} | @yield('title')</title>

    @include('admin.head.css')
    @include('admin.head.scripts')

</head>
<body id="app-layout">
    <div id="container" class="effect mainnav-sm footer-fixed">
   
        @include('admin.header.navigation')

        <div class="boxed">

            @include('admin.content.content')
            
            @if (Auth::check())
                @include('admin.sidebar.navigation')
                @include('admin.sidebar.aside')  
            @endif          

        </div>

        @include('admin.footer.footer')

        <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>

    </div>

    @include('admin.footer.scripts')
</body>
</html>
