@extends("layouts.blank")

@section("title" , __("Coming soon"))

@push("styles")
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/css/pages/page-misc.css")}}"/>
@endpush

@section("content")
    <div class="container-xxl py-4">
        <div class="misc-wrapper">
            <h3 class="mb-2 mx-2">{{__('We are coming soon')}} 🚀</h3>
            <p class="mb-5 mx-2">{{__("Our website is opening soon. Please wait until it's ready!")}}</p>

            <a href="{{route("dashboard.home.index")}}" class="btn btn-primary mb-3">{{__('Back to home')}}</a>
            @auth
                <a class="btn btn-danger" href="{{ route('dashboard.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">{{__('Log Out')}}</span>
                </a>
                <form id="frm-logout" action="{{ route('dashboard.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endauth
            <div class="mt-5">
                <img src="{{asset("assets/admin/sneat/img/illustrations/boy-with-rocket-light.png")}}" alt="boy-with-rocket-light" width="500" class="img-fluid" data-app-dark-img="illustrations/boy-with-rocket-dark.png" data-app-light-img="illustrations/boy-with-rocket-light.png">
            </div>
        </div>
    </div>
@endsection
