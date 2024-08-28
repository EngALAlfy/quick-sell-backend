@extends("layouts.tagger")

@section("title" , "Settings")

@section("description" , "Store Settings")

@section("content")
    <div class="row g-6">

        @include("tagger.store-settings.navigation")

        <!-- Options -->
        <div class="col-12 col-lg-8 pt-6 pt-lg-0">
            <div class="tab-content p-0">
                <div class="tab-pane show active" id="home" role="tabpanel">
                    {{html()->form()->route("tagger.settings.home.store")->open()}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{__('Home page components')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md mb-md-0 mb-5 h-100">
                                    @include("includes.switch-icon-description" , [
                                        "name" => "store_setting_footer_enabled",
                                        "title" => __("Page footer enabled"),
                                        "description" => __("Make store footer appear in all pages"),
                                        "checked" => filter_var($settings["store_setting_footer_enabled"] ?? 0 , FILTER_VALIDATE_BOOLEAN) ?? false,
                                        "icon" => "bx-lock",
                                    ])
                                </div>
                                <div class="col-md mb-md-0 mb-5 h-100">
                                    @include("includes.switch-icon-description" , [
                                        "name" => "store_setting_reviews_enabled",
                                        "title" => __("Page reviews enabled"),
                                        "description" => __("Make store clients reviews appear in home page"),
                                        "icon" => "bx-lock",
                                        "checked" => filter_var($settings["store_setting_reviews_enabled"] ?? 0 , FILTER_VALIDATE_BOOLEAN) ?? false,
                                    ])
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md mb-md-0 mb-5 h-100">
                                    @include("includes.switch-icon-description" , [
                                        "name" => "store_setting_categories_enabled",
                                        "title" => __("Page categories enabled"),
                                        "description" => __("Make store categories appear in home page"),
                                        "icon" => "bx-lock",
                                        "checked" => filter_var($settings["store_setting_categories_enabled"] ?? 0 , FILTER_VALIDATE_BOOLEAN) ?? false,
                                    ])
                                </div>

                                <div class="col-md mb-md-0 mb-5 h-100">
                                    @include("includes.switch-icon-description" , [
                                        "name" => "store_setting_features_enabled",
                                        "title" => __("Home Page store features enabled"),
                                        "description" => __("Make store features appear in home page"),
                                        "icon" => "bx-lock",
                                        "checked" => filter_var($settings["store_setting_features_enabled"] ?? 0 , FILTER_VALIDATE_BOOLEAN) ?? false,
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{__('Setup Homepage')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row my-3">
                                @include('includes.select', [
                                    'name' => 'store_settings_home_products_categories[]',
                                    'title' => __('Home Products Categories'),
                                    'required' => true,
                                    'floating' => false,
                                    'value' => json_decode($settings["store_settings_home_products_categories"] ?? "[]") ?? '-1',
                                    'options' => $categories,
                                    'col' => '12',
                                    'multi' => true,
                                    "classes" => "select2 mb-4 fv-plugins-icon-container",
                                ])
                            </div>
                            <div class="row my-3">
                                @include('includes.select', [
                                    'name' => 'store_settings_home_categories[]',
                                    'title' => __('Home Categories'),
                                    'required' => true,
                                    'floating' => false,
                                    'value' => json_decode($settings["store_settings_home_categories"] ?? "[]") ?? '-1',
                                    'options' => $categories,
                                    'col' => '12',
                                    'multi' => true,
                                    "classes" => "select2 mb-4 fv-plugins-icon-container",
                                ])
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-4 mt-5">
                        <button type="reset" class="btn btn-label-secondary">{{__("Discard")}}</button>
                        <button class="btn btn-primary" type="submit">{{__("Save Changes")}}</button>
                    </div>
                    {{html()->form()->close()}}
                </div>
            </div>
        </div>
        <!-- /Options-->
    </div>
@endsection
