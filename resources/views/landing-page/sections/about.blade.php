<!-- About Section -->
<section id="about" class="about section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center justify-content-between">

            <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                <span class="about-meta">{{ __('MORE ABOUT US') }}</span>
                <h2 class="about-title">{{ __('Transforming Your Business with Technology') }}</h2>
                <p class="about-description">{{ __('Our platform is designed to help businesses streamline their operations, manage inventory, handle sales, and improve customer experiences. With over 8 years of expertise, we have developed a comprehensive solution that scales with your business.') }}</p>

                <div class="row feature-list-wrapper">
                    <div class="col-md-6">
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> {{ __('Seamless Inventory Management') }}</li>
                            <li><i class="bi bi-check-circle-fill"></i> {{ __('Multi-role User Management') }}</li>
                            <li><i class="bi bi-check-circle-fill"></i> {{ __('Integrated Sales and Purchase Modules') }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> {{ __('Real-time Reporting and Analytics') }}</li>
                            <li><i class="bi bi-check-circle-fill"></i> {{ __('Secure Data with Backup Solutions') }}</li>
                            <li><i class="bi bi-check-circle-fill"></i> {{ __('Customizable and Scalable Platform') }}</li>
                        </ul>
                    </div>
                </div>

                <div class="info-wrapper">
                    <div class="row gy-4">
                        <div class="col-lg-5">
                            <div class="profile d-flex align-items-center gap-3">
                                <img src="https://alalfy.com/storage/uploads/profile_1.jpeg" alt="{{ __('CEO Profile') }}" class="profile-image">
                                <div>
                                    <h4 class="profile-name">{{ __('Islam Alalfy') }}</h4>
                                    <p class="profile-position">{!!  __('CEO &amp; Founder')  !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="contact-info d-flex align-items-center gap-2">
                                <i class="bi bi-telephone-fill"></i>
                                <div>
                                    <p class="contact-label">{{ __('Call us anytime') }}</p>
                                    <p class="contact-number">+2 011 532 63 994</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                <div class="image-wrapper">
                    <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                        <img src="{{asset("assets/landing-page/img/about-5.webp")}}" alt="{{ __('Business Meeting') }}" class="img-fluid main-image rounded-4">
                        <img src="{{asset("assets/landing-page/img/about-2.webp")}}" alt="{{ __('Team Discussion') }}" class="img-fluid small-image rounded-4">
                    </div>
                    <div class="experience-badge floating">
                        <h3>8+ <span>{{ __('Years') }}</span></h3>
                        <p>{{ __('Of experience in business service') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section><!-- /About Section -->
