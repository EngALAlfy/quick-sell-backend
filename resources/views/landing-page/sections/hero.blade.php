
<!-- Hero Section -->
<section id="hero" class="hero section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                    <div class="company-badge mb-4">
                        <i class="bi bi-gear-fill me-2"></i>
                        {{__('Working for your success')}}
                    </div>

                    <h1 class="mb-4">
                        {{ __('Empower Your Business') }} <br>
                        {{ __('Streamline Sales with') }} <br>
                        <span class="accent-text">{{ __('QuickSell') }}</span>
                    </h1>

                    <p class="mb-4 mb-md-5">
                        {{ __('Revolutionize the way you manage your store. With advanced tools for sales, stock, and transactions, QuickSell is your all-in-one solution to simplify operations and boost efficiency.') }}
                    </p>


                    <div class="hero-buttons">
                        <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">{{__('Get Started')}}</a>
                        <a href="{{asset("assets/landing-page/video/QuickSell.mp4")}}"
                           class="btn btn-link mt-2 mt-sm-0 glightbox">
                            <i class="bi bi-play-circle me-1"></i>
                            {{__('Play Video')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                    <img src="{{asset('assets/landing-page/img/shots/screen-5.png')}}" alt="Hero Image" class="img-fluid">
                </div>
            </div>
        </div>

        <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
            <div class="col-lg-3 col-md-6">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="stat-content">
                        <h4>Unlimited {{ __('Products & Sales') }}</h4>
                        <p class="mb-0">{{ __('No limits, grow your business without constraints.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <div class="stat-content">
                        <h4>{{ __('Comprehensive Reports & Charts') }}</h4>
                        <p class="mb-0">{{ __('Gain insights with detailed analytics.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-server"></i>
                    </div>
                    <div class="stat-content">
                        <h4>99.99% {{ __('Uptime Guaranteed') }}</h4>
                        <p class="mb-0">{{ __('Reliable performance, always available.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <div class="stat-content">
                        <h4>24/7 {{ __('Support & Assistance') }}</h4>
                        <p class="mb-0">{{ __('Always here to help when you need us.') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
<!-- /Hero Section -->
