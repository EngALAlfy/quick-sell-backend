<!DOCTYPE html>
<html lang="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale() }}"
      dir="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    @include("landing-page.sections.head")
</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center fixed-top">
    <div
        class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{url("/")}}" class="logo d-flex align-items-center me-auto me-xl-0">
            <h1 class="sitename">{{__(config("app.name"))}}</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">{{__('Home')}}</a></li>
                <li><a href="#about">{{__('About')}}</a></li>
                <li><a href="#features">{{__('Features')}}</a></li>
                <li><a href="#pricing">{{__('Pricing')}}</a></li>
                <li><a href="#contact">{{__('Contact')}}</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="#about">{{__('Get Started')}}</a>

    </div>
</header>

<main class="main">
    @include("landing-page.sections.hero")

    @include("landing-page.sections.about")

    @include("landing-page.sections.features-1")

    @include("landing-page.sections.features-2")

    @include("landing-page.sections.features-3")

    @include("landing-page.sections.call-to-action")

{{--    @include("landing-page.sections.testimonials")--}}

    @include("landing-page.sections.stats")

    @include("landing-page.sections.pricing")

    @include("landing-page.sections.faq")

    @include("landing-page.sections.call-to-action-2")

    @include("landing-page.sections.contact")

</main>

@include("landing-page.sections.footer")

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@include("landing-page.sections.scripts")

</body>

</html>
