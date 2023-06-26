<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8" />
    @include('tenant.layouts.partials.head')
    <style>
        .menu-item {
            display: block;
            padding: 0rem 0;
        }
    </style>
    @stack('css_page')
</head>

<body id="kt_app_body" class="app-default">

    @include('tenant.layouts.partials.themeMode')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
                <div class="d-flex flex-column-fluid flex-column w-100 mw-450px">
                    <a href="/" class="d-block mx-auto py-20">
                        <img alt="Logo" src="{{ global_asset('/assets/media/logos/athena_clinic.svg') }}"
                            class="theme-light-show h-125px" />
                        <img alt="Logo" src="{{ global_asset('/assets/media/logos/athena_clinic-dark.svg') }}"
                            class="theme-dark-show h-125px" />
                    </a>
                    @yield('content')
                </div>
            </div>
            <div class="d-none d-lg-flex flex-lg-row-fluid w-50 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat"
                style="background-image: url({{ global_asset('/assets/media/auth/bg11.png') }})"></div>
        </div>
    </div>
    @include('tenant.layouts.commons.modals')
    @include('tenant.layouts.commons.sidemodal')
    @include('tenant.layouts.partials.scripts')
    @include('tenant.layouts.commons.flash')
</body>

</html>
