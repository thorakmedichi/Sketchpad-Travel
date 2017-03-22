<!DOCTYPE html>
<html>
<head>
    <title>{{ Config::get('brand.admin_brand')  }} | @yield('title')</title>

    <link href="{{ url('css/errors.css') }}" rel='stylesheet' type='text/css' />
</head>
<body>
    @yield('content')
</body>
</html>