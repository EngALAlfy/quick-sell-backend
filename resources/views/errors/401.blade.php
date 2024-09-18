@extends("layouts.blank")

@section("title" , __("Not authorized"))

@push("styles")
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/css/pages/page-misc.css")}}"/>
@endpush

@section("content")
    <div class="misc-wrapper">
        <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">401</h1>
        <h4 class="mb-2 mx-2">{{__("You are not authorized!")}} 🔐</h4>
        <p class="mb-6 mx-2">{{__("You don’t have permission to access this page. Go Home!")}}</p>
        <a href="{{route("dashboard.home.index")}}" class="btn btn-primary">{{__('Back to home')}}</a>
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
            <img src="{{asset("assets/admin/sneat/img/illustrations/girl-with-laptop-light.png")}}" alt="page-misc-not-authorized-light" width="500" class="img-fluid" data-app-light-img="illustrations/girl-with-laptop-light.png" data-app-dark-img="illustrations/girl-with-laptop-dark.png">
        </div>
    </div>
@endsection
