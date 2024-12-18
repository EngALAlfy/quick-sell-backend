<!-- Contact Section -->
<section id="contact" class="contact section light-background">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>{{ __('Contact Us') }}</h2>
        <p>{{ __('We would love to hear from you. Reach out to us with any inquiries or feedback!') }}</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 g-lg-5">
            <div class="col-lg-5">
                <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                    <h3>{{ __('Contact Information') }}</h3>
                    <p>{{ __('Feel free to get in touch with us. We are here to assist you.') }}</p>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="content">
                            <h4>{{ __('Our Location') }}</h4>
                            <p>{{ __('New Cairo') }}</p>
                            <p>{{ __('Cairo, Egypt') }}</p>
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon-box">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="content">
                            <h4>{{ __('Phone Numbers') }}</h4>
                            <p>{{ __('+2 011 532 63 994') }}</p>
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="content">
                            <h4>{{ __('Email Addresses') }}</h4>
                            <p>{{ __('islam@alalfy.com') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                    <h3>{{ __('Get In Touch') }}</h3>
                    <p>{{ __('Fill out the form below, and we’ll get back to you as soon as possible.') }}</p>

                    <form action="{{route("contact")}}" method="post" class="php-email-form" data-aos="fade-up"
                          data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="{{ __('Your Name') }}"
                                       required="">
                            </div>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email"
                                       placeholder="{{ __('Your Email') }}"
                                       required="">
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control" name="subject" placeholder="{{ __('Subject') }}"
                                       required="">
                            </div>

                            <div class="col-12">
                                    <textarea class="form-control" name="message" rows="6"
                                              placeholder="{{ __('Message') }}"
                                              required=""></textarea>
                            </div>

                            <div class="col-12 text-center">
                                @include("flash::message")
                                <button type="submit" class="btn">{{ __('Send Message') }}</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
