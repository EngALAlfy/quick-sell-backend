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

        <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">iLanding</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="index.html#about">Get Started</a>

    </div>
</header>

<main class="main">
    @include("landing-page.sections.hero")

    @include("landing-page.sections.about")

    @include("landing-page.sections.features-1")

    @include("landing-page.sections.features-2")

    @include("landing-page.sections.features-3")

    @include("landing-page.sections.call-to-action")

    @include("landing-page.sections.clients")

    @include("landing-page.sections.testimonials")

    @include("landing-page.sections.stats")

    @include("landing-page.sections.services")

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
