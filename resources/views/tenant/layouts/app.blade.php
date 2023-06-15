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

<body id="kt_app_body" data-kt-app-layout="dark-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-enabled="true"
    data-kt-app-toolbar-fixed="true" class="app-default">
    @include('tenant.layouts.partials.themeMode')
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('tenant.layouts.partials.header')
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    @include('tenant.layouts.commons.toolbar')
                    @yield('content')
                    @include('tenant.layouts.partials.footer')
                </div>
            </div>
        </div>
    </div>
    @include('tenant.layouts.commons.modals')
    @include('tenant.layouts.commons.sidemodal')
    @include('tenant.layouts.partials.scripts')

</body>

</html>
