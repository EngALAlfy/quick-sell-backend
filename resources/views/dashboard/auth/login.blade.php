<!DOCTYPE html>
<html
    lang="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}"
    dir="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() }}"
    class="light-style layout-wide  customizer-hide" data-theme="theme-default"
    data-assets-path="{{asset("assets/admin/sneat/")}}"
    data-template="vertical-menu-template">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>{{__('Login')}} | {{__('Dashboard')}} - {{settings("title" , config("app.name"))}}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{settings("logo_path_public_path" , asset("favicon.ico"))}}"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/fonts/boxicons.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/fonts/fontawesome.css")}}"/>
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/fonts/flag-icons.css")}}"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/css/core.css")}}"
          class="template-customizer-core-css"/>
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/css/theme-default.css")}}"
          class="template-customizer-theme-css"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css")}}"/>
    <!-- Vendor -->
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/libs/@form-validation/form-validation.css")}}"/>

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/css/pages/page-auth.css")}}">

    <!-- Helpers -->
    <script src="{{asset("assets/admin/sneat/vendor/js/helpers.js")}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{asset("assets/admin/sneat/vendor/js/template-customizer.js")}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset("assets/admin/sneat/js/config.js")}}"></script>

</head>

<body>

<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="{{route("dashboard.login")}}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{settings("logo_path_public_path" , asset("assets/admin/sneat/img/logo.png"))}}" width="50" height="50">
                            </span>
                            <span class="app-brand-text demo text-body fw-bold">{{settings("title" , config("app.name"))}}</span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <h4 class="mb-2">{{settings("title" , config("app.name"))}} {{__('Dashboard!')}} 👋</h4>
                    <p class="mb-4">{{__('Please sign-in to your account')}}</p>

                    @include("includes.status")
                    {{html()->form()->route("dashboard.login")->id("formAuthentication")->class("mb-3")->open()}}
                        <div class="mb-3">
                            <label for="email" class="form-label">{{__('Email')}}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="{{__('Enter your email to login')}}"
                                autofocus/>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">{{__('Password')}}</label>
                                <a href="{{route("dashboard.forget-password")}}">
                                    <small>{{__('Forgot Password ?')}}</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password"/>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me"/>
                                <label class="form-check-label" for="remember-me"> {{__('Remember Me')}} </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">{{__('Sign in')}}</button>
                        </div>
                        <div class="mb-3">
                            <a class="btn btn-warning d-grid w-100" href="{{route("dashboard.demoLogin")}}">{{__('Try demo')}}</a>
                        </div>
                    {{html()->form()->close()}}
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<!-- / Content -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset("assets/admin/sneat/vendor/libs/jquery/jquery.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/popper/popper.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/js/bootstrap.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/hammer/hammer.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/i18n/i18n.js")}}"></script>
<script src="{{asset("assets/vendor/libs/typeahead-js/typeahead.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/js/menu.js")}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset("assets/admin/sneat/vendor/libs/@form-validation/popular.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/@form-validation/bootstrap5.js")}}"></script>
<script src="{{asset("assets/admin/sneat/vendor/libs/@form-validation/auto-focus.js")}}"></script>

<!-- Main JS -->
<script src="{{asset("assets/admin/sneat/js/main.js")}}"></script>

<!-- Page JS -->

</body>
</html>
