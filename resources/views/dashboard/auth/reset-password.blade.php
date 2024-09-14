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

    <title>{{__('Forget Password')}} | {{__('Dashboard')}} - {{settings("title" , config("app.name"))}}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{settings("logo_path_public_path" , asset("favicon.ico"))}}"/>

    @include("store-customer.includes.styles")

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/css/pages/page-auth.css")}}">
</head>

<body>

<!-- Content -->
<div class="authentication-wrapper authentication-cover">
    <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
            <div class="w-100 d-flex justify-content-center">
                <a href="{{route("store-customer.login", $store)}}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        <img src="{{settings("logo_path_public_path" , asset("assets/admin/sneat/img/logo.png"))}}" width="50" height="50">
                    </span>
                    <span class="app-brand-text demo text-body fw-bold">{{__(settings("title" , config("app.name")))}}</span>
                </a>
            </div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <!-- Logo -->
                <div class="app-brand mb-5">
                    <a href="{{route("store-customer.login", $store)}}" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <img src="{{settings("logo_path_public_path" , asset("assets/admin/sneat/img/logo.png"))}}" width="50" height="50">
                        </span>
                        <span class="app-brand-text demo text-body fw-bold">{{__(settings("title" , config("app.name")))}}</span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">{{__(settings("title" , config("app.name")))}} 👋</h4>
                <p class="mb-4">Please enter your new password</p>

                @include("includes.status")
                {{html()->form()->route("store-customer.password.update", $store)->id("formAuthentication")->class("mb-3")->open()}}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label for="email" class="form-label">{{__('Email')}}</label>
                        <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            value="{{ $email ?? old('email') }}"
                            placeholder="{{__('Enter your email to reset password')}}"
                            autofocus/>
                    </div>
                    <div class="mb-3 form-password-toggle">
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
                    <div class="mb-3 form-password-toggle">
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password_confirmation"
                                class="form-control"
                                name="password_confirmation"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password_confirmation"/>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">{{__('Reset Password')}}</button>
                    </div>
                {{html()->form()->close()}}
            </div>
        </div>
        <!-- /Login -->
    </div>
</div>

<!-- / Content -->

@include("store-customer.includes.scripts")

<!-- Page JS -->
<script src="{{asset("assets/admin/sneat/js/pages-auth.js")}}"></script>

</body>

</html>
