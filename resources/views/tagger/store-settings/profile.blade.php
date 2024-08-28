@extends("layouts.tagger")

@section("title" , "Settings")

@section("description" , "Store Settings")

@section("content")
    <div class="row g-6">

        @include("tagger.store-settings.navigation")

        <!-- Options -->
        <div class="col-12 col-lg-8 pt-6 pt-lg-0">
            <div class="tab-content p-0">
                <div class="tab-pane show active" id="store_details" role="tabpanel">
                    {{html()->form()->route("tagger.settings.profile.store")->open()}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{__('Profile')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-6 g-6">
                                @include("includes.editable-input", ["name" => "name", "title" => __('Name'), "value" => $store->name])
                                @include("includes.editable-input", ["name" => "slug", "title" => __('Slug'), "value" => $store->slug])
                                @include("includes.editable-input", ["name" => "description", "title" => __('Description'), "value" => $store->description])
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{__('Contact')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-6 g-6">
                                @include("includes.editable-input", ["name" => "contact_email", "title" => __('Contact Email'), "value" => $store->contact_email])
                                @include("includes.editable-input", ["name" => "contact_phone", "title" => __('Contact Phone'), "value" => $store->contact_phone])
                                @include("includes.editable-input", ["name" => "contact_whatsapp", "title" => __('Contact WhatsApp'), "value" => $store->contact_whatsapp])
                                @include("includes.editable-input", ["name" => "contact_facebook", "title" => __('Contact Facebook'), "value" => $store->contact_facebook])
                                @include("includes.editable-input", ["name" => "contact_instagram", "title" => __('Contact Instagram'), "value" => $store->contact_instagram])
                                @include("includes.editable-input", ["name" => "contact_youtube", "title" => __('Contact YouTube'), "value" => $store->contact_youtube])
                                @include("includes.editable-input", ["name" => "contact_snapchat", "title" => __('Contact Snapchat'), "value" => $store->contact_snapchat])
                                @include("includes.editable-input", ["name" => "contact_twitter", "title" => __('Contact Twitter'), "value" => $store->contact_twitter])
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{__('Address')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-6 g-6">
                                @include("includes.editable-input", ["name" => "address", "title" => __('Address'), "value" => $store->address])
                                @include("includes.editable-input", ["name" => "city", "title" => __('City'), "value" => $store->city])
                                @include("includes.editable-input", ["name" => "state", "title" => __('State'), "value" => $store->state])
                                @include("includes.editable-input", ["name" => "country", "title" => __('Country'), "value" => $store->country])
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{__('Logo')}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-6 g-6">
                                @include("includes.dropzone" , [
                                    "name" => "logo",
                                    "title" => __('logo'),
                                    "size" => isset($store) ? optional($store)->getFirstMedia('logo')?->size: null,
                                    "file_name" => isset($store) ? optional($store)->getFirstMedia('logo')?->file_name: null,
                                    "storage_path" => isset($store) ? optional($store)->getFirstMedia('logo')?->id: null,
                                    "public_path" => isset($store) ? optional($store)->getFirstMedia('logo')?->getUrl(): null
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
