<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('pageTitle')</title>
    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/styles/index.css"/>

    @stack('stylesheets')
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed">
        <div class="container-xxl">
            <a class="navbar-brand" href="/">
                <img src="{{ settings()->site_logo }}" alt="{{ settings()->site_title }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 d-flex gap-4 justify-content-end w-100 mt-1">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pages</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
@yield('content')
<footer>
    <div class="container-xxl">
        <a class="navbar-brand" href="/">
            <img width="100" src="{{ settings()->site_logo }}" alt="{{ settings()->site_title }}">
        </a>
    </div>
</footer>
<script src="/assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
