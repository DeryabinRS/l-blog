
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
        href="/backend/vendors/images/favicon-32x32.png"
    />
    <!-- Mobile Specific Metas -->
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1"
    />

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/core.css" />
    <link
        rel="stylesheet"
        type="text/css"
        href="/backend/vendors/styles/icon-font.min.css"
    />
    <link rel="stylesheet" type="text/css" href="/backend/vendors/styles/style.css" />
    @stack('stylesheets')
</head>
<body class="login-page">
<div class="login-header box-shadow">
    <div
        class="container-fluid d-flex justify-content-between align-items-center"
    >
        <div class="brand-logo">
            <a href="/">
                <img src="{{ isset(settings()->site_logo) ? settings()->site_logo : '/images/settings/logo.svg' }}" alt="" />
            </a>
        </div>
        <div class="login-menu">
            <ul>
                <li><a href="register.html">Register</a></li>
            </ul>
        </div>
    </div>
</div>
<div
    class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
>
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

<!-- js -->
<script src="/backend/vendors/scripts/core.js"></script>
<script src="/backend/vendors/scripts/script.min.js"></script>
<script src="/backend/vendors/scripts/process.js"></script>
<script src="/backend/vendors/scripts/layout-settings.js"></script>
@stack('scripts')
</body>
</html>
