@extends("layouts.blank")

@section("title" , __("Not found"))

@push("styles")
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/css/pages/page-misc.css")}}"/>
@endpush

@section("content")
        <div class="misc-wrapper">
            <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">404</h1>
            <h4 class="mb-2 mx-2">{{__("Page Not Found️")}} ⚠️</h4>
            <p class="mb-6 mx-2">{{__("we couldn't find the page you are looking for")}}</p>
            <a href="{{route("dashboard.home.index")}}" class="btn btn-primary">{{__('Back to home')}}</a>
            <div class="mt-5">
                <img src="{{asset("/assets/admin/sneat/img/illustrations/page-misc-error-light.png")}}" alt="page-misc-error-light" width="500" class="img-fluid" data-app-light-img="illustrations/page-misc-error-light.png" data-app-dark-img="illustrations/page-misc-error-dark.png">
            </div>
        </div>
@endsection
