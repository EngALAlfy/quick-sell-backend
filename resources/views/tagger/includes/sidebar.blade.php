<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route("admin.home.index")}}" class="app-brand-link">
              <span class="app-brand-logo demo">
                  <img height="50" width="50" src="{{asset("assets/admin/sneat/img/logo.png")}}" alt="{{__("Toggar")}}">
              </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{__("Toggar")}}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    {!! Menu::tagger() !!}

</aside>
