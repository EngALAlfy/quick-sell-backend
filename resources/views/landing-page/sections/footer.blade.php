<footer id="footer" class="footer">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-4 footer-about">
                <a href="{{url("/")}}" class="logo d-flex align-items-center">
                    <span class="sitename">{{ __(config('app.name')) }}</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>{{ __('New Cairo') }}</p>
                    <p>{{ __('Cairo, Egypt') }}</p>
{{--                    <p class="mt-3"><strong>{{ __('Phone:') }}</strong> <span>+201153263994</span></p>--}}
                    <p><strong>{{ __('Email:') }}</strong> <span>info@quicksell-system.com</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href="https://www.facebook.com/yotech.org"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.linkedin.com/company/yotechorg"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 footer-links">
                <h4>{{ __('Useful Links') }}</h4>
                <ul>
                    <li><a href="#hero">{{ __('Home') }}</a></li>
                    <li><a href="#about">{{ __('About us') }}</a></li>
                    <li><a href="#">{{ __('Terms of service') }}</a></li>
                    <li><a href="#">{{ __('Privacy policy') }}</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-4 footer-links">
                <h4>{{ __('Our Services') }}</h4>
                <ul>
                    <li><a href="https://yotech.org">{{ __('Web Design') }}</a></li>
                    <li><a href="https://alalfy.com">{{ __('Web Development') }}</a></li>
                    <li><a href="https://yotech.org">{{ __('Mobile Development') }}</a></li>
                    <li><a href="https://alalfy.com">{{ __('Server Management') }}</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>{{ __('Copyright') }}</span> <strong class="px-1 sitename">{{ __(config('app.name')) }}</strong> <span>{{ __('All Rights Reserved') }}</span></p>
        <div class="credits">
            {{ __('Designed by') }} <a href="https://yotech.org/">{{__('YoTech')}}</a>
        </div>
    </div>
</footer>
