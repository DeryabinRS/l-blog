
<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>DRSCript - @yield('pageTitle')</title>

    <!-- Site favicon -->
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="/assets/images/favicon.png"
    />
    <!-- Mobile Specific Metas -->
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1"
    />

    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap/bootstrap.min.css"/>
    @stack('stylesheets')
    @stack('head_scripts')
</head>
<body class="login-page">
<div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="brand-logo">
            <a href="/">
                <img src="{{ isset(settings()->site_logo) ? settings()->site_logo : '/assets/images/logo.png' }}" alt="" />
            </a>
        </div>
        <div class="login-menu">
            <ul>
                <li>
                    @if(Route::is('register'))
                        <a href="{{ route('login') }}" class="text-secondary">
                            Вход
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="text-secondary">
                            Регистрация
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7">
                <img src="/backend/src/images/login-page-img.png" alt="" />
            </div>
            <div class="col-md-6 col-lg-5">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="/assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
