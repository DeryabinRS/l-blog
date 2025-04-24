<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('pageTitle')</title>
    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap/bootstrap.min.css"/>
    @stack('stylesheets')
</head>
<body>
<header id="header">

</header>
@yield('content')

<script src="/assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
