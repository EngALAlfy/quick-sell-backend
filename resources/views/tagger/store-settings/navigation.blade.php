<!-- Navigation -->
<div class="col-12 col-lg-4">
    <div class="d-flex justify-content-between flex-column mb-4 mb-md-0">
        <ul class="nav nav-align-left nav-pills flex-column">
            <li class="nav-item mb-1">
                <a @class(["nav-link" , "active" => Route::currentRouteName() == "tagger.settings.profile"]) href="{{route("tagger.settings.profile")}}">
                    <i class="bx bx-store-alt bx-sm me-1"></i>
                    <span class="align-middle">{{__('Store details')}}</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a @class(["nav-link" ,"active" => \Illuminate\Support\Facades\Route::currentRouteName() == "tagger.settings.home"]) href="{{route("tagger.settings.home")}}">
                    <i class="bx bx-home bx-sm me-1"></i>
                    <span class="align-middle">{{__("Home Page")}}</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a @class(["nav-link" ,"active" => \Illuminate\Support\Facades\Route::currentRouteName() == "tagger.settings.home"]) href="{{route("tagger.settings.home")}}">
                    <i class="bx bxl-html5 bx-sm me-1"></i>
                    <span class="align-middle">{{__("Website Design")}}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- /Navigation -->
