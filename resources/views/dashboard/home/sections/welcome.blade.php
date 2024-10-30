<div class="col-lg-8 mb-5 order-0">
    <div class="card">
        <div class="d-flex align-items-start row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">{{ __('Hi') }} {{auth()->user()->name}}! 🎉</h5>
                    <p class="mb-5">{{ __('Welcome to ') }}{{ settings("title" , config("app.name")) }}.</p>
                    <a href="{{ route('dashboard.profile.index') }}" class="btn btn-sm btn-outline-primary">{{ __('View Profile') }}</a>
                </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-5">
                    <img src="{{ asset('assets/admin/sneat/img/illustrations/man-with-laptop-light.png') }}" height="175" class="scaleX-n1-rtl" alt="{{ __('View Badge User') }}">
                </div>
            </div>
        </div>
    </div>
</div>
