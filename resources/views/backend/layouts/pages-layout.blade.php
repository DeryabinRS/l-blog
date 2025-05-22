<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8"/>
    <title>DRSCript - @yield('pageTitle')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Site favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon.png" />
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="/assets/plugins/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/plugins/sweetalert2/sweetalert2.css" />
    @kropifyStyles
    @stack('stylesheets')
</head>
<body class="header-white sidebar-light">
<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
    </div>
    <div class="header-right">
        @livewire('admin.top-user-info')
    </div>
</div>

<div class="left-side-bar">
    <div class="brand-logo">
        <a href="/">
            <img
                src="{{ isset(settings()->site_logo) ? settings()->site_logo : '/assets/images/logo.png' }}"
                alt=""
                class="site_logo"
            />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="dropdown-toggle no-arrow {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                    >
                        <span class="micon fa fa-home"></span>
                        <span class="mtext">Home</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-list"></span>
                        <span class="mtext">Меню</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.add_menu_item') }}">Добавить</a></li>
                        <li><a href="{{ route('admin.menu_items') }}">Список меню</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon fa fa-file-o"></span>
                        <span class="mtext">Страницы</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.add_page') }}" class="{{ Route::is('admin.add_page') ? 'active' : '' }}">Добавить</a></li>
                        <li><a href="{{ route('admin.pages') }}" class="{{ Route::is('admin.pages') ? 'active' : '' }}">Список страниц</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a
                        href="javascript:;"
                        class="dropdown-toggle">
                        <span class="micon fa fa-newspaper-o"></span>
                        <span class="mtext"> События </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.add_post') }}" class="{{ Route::is('admin.add_post') ? 'active' : '' }}">Добавить</a></li>
                        <li><a href="{{ route('admin.posts') }}" class="{{ Route::is('admin.posts') || Route::is('admin.edit_post') ? 'active' : '' }}">Список событий</a></li>
                        <li>
                            <a
                                href="{{ route('admin.post_categories') }}"
                                class="{{ Route::is('admin.post_categories') ? 'active' : '' }}"
                            >
                                Категории событий
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-command"></span>
                        <span class="mtext">Услуги</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="">Добавить</a></li>
                        <li><a href="">Список услуг</a></li>
                    </ul>
                </li>
                <li>
                    <a
                        href="{{ route('admin.users') }}"
                        class="dropdown-toggle no-arrow {{ Route::is('admin.users') ? 'active' : '' }}"
                    >
                        <span class="micon fa fa-users"></span>
                        <span class="mtext">Пользователи</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/filemanager" target="_blank" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-files"></span>
                        <span class="mtext">Файловый менеджер</span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap text-secondary">Настройки</div>
                </li>
                <li>
                    <a
                        href="{{ route('admin.profile') }}"
                        class="dropdown-toggle no-arrow {{ Route::is('admin.profile') ? 'active' : '' }}"
                    >
                        <span class="micon fa fa-user-circle"></span>
                        <span class="mtext">Профиль</span>
                    </a>
                </li>
                @if(auth()->user()->role == 'superAdmin')
                <li>
                    <a
                        href="{{ route('admin.settings') }}"
                        class="dropdown-toggle no-arrow {{ Route::is('admin.settings') ? 'active' : '' }}"
                    >
                        <span class="micon fa fa-cogs"></span>
                        <span class="mtext">Настройки</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <x-form-alerts></x-form-alerts>
            <div class="">
                @yield('content')
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DRSCript
        </div>
    </div>
</div>

<script src="/assets/plugins/jquery/jquery-3.7.1.min.js"></script>
<script src="/assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>
<script src="/plugins/sweetalert2/sweetalert2.all.js"></script>
@kropifyScripts
<script>
    window.addEventListener('showToast', function (event) {
        const configSwal = {
            toast: event.detail[0]?.toast === undefined ? true : false,
            position: event.detail[0].position || 'top-end',
            type: event.detail[0].type,
            title: event.detail[0].message,
            text: event.detail[0]?.text,
            timerProgressBar: true,
            showConfirmButton: false,
            timer: event.detail[0]?.timer || 2500,
        }

        swal(configSwal);

    })
</script>

@stack('scripts')
</body>
</html>
