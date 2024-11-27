<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Index - iLanding Bootstrap Template</title>
<meta name="description" content="">
<meta name="keywords" content="">

<!-- Favicons -->
<link href="{{ asset('assets/landing-page/img/favicon.png') }}" rel="icon">
<link href="{{ asset('assets/landing-page/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

<!-- Vendor CSS Files -->
@if (\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() === 'rtl')
    <link href="{{ asset('assets/landing-page/vendor/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
@else
    <link href="{{ asset('assets/landing-page/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
@endif

<link href="{{ asset('assets/landing-page/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/landing-page/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('assets/landing-page/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/landing-page/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

@if (\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() === 'rtl')
    <style>
        /* Fonts */
        @font-face {
            font-family: 'GEDinarOneMedium';
            src: url('{{asset("assets/landing-page/fonts/GE Dinar One Medium.otf")}}') format('opentype');
        }

        :root {
            --default-font: "GEDinarOneMedium", "Roboto", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --heading-font: "GEDinarOneMedium", "Nunito", sans-serif;
            --nav-font: "GEDinarOneMedium", "Inter", sans-serif;
        }
    </style>
@else
    <style>
        /* Fonts */
        :root {
            --default-font: "Roboto", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --heading-font: "Nunito", sans-serif;
            --nav-font: "Inter", sans-serif;
        }
    </style>
@endif

<!-- Main CSS File -->
<link href="{{ asset('assets/landing-page/css/main.css') }}?v=1" rel="stylesheet">
