<!DOCTYPE html>
<html
    lang="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}"
    dir="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() }}"
    class="light-style layout-menu-fixed layout-compact"
    data-theme="theme-default"
    data-assets-path="{{asset("assets/admin/sneat/")}}"
    data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>@yield("title") | {{__('Panel')}} - {{__(config("app.name"))}}</title>

    <meta name="description" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset("favicon.ico")}}"/>

    @include("dashboard.includes.styles")
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include("dashboard.includes.sidebar")
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            @include("dashboard.includes.header")

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="py-3">@yield("title")</h4>
                    <p>@yield("description")</p>
                    @include("includes.status")
                    @yield("content")
                </div>
                <!-- / Content -->

                <!-- Footer -->
                @include("dashboard.includes.footer")
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

@include("dashboard.includes.scripts")
</body>
</html>
