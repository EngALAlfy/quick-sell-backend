<!DOCTYPE html>
<html  lang="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}"
       dir="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() }}">

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>

<head>
    @include('store-customer.includes.head-style')
</head>

<body class="index salla-525144736 color-mode-light font-apple">
    <noscript>
        To get full functionality of this site you need to enable JavaScript. Here is how
        <a href="https://www.enable-javascript.com/" rel="noreferrer" target="_blank">To enable JavaScript on
            webpage</a>.
    </noscript>

    <div class="body-blackout"></div>
    @yield('content')
    @include('store-customer.includes.scripts')
</body>
</html>
