<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="csrf-token" content="{!! csrf_token() !!}">

    <title>{{ Config::get('brand.admin_brand')  }} | @yield('title')</title>

    @include('front.head.css')
    @include('front.head.scripts')

</head>