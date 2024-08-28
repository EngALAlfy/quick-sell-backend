@extends("layouts.admin")

@section("title" , "Settings")

@section("description" , "Website Settings")

@section("content")
    <div class="row gutters">
        <div class="col-12">
            {!! html()->form()->acceptsFiles()->route("admin.settings.store")->open() !!}
            <div class="card">
                <div class="card-header">
                    <h3>{{__('Settings')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            @include("admin.includes.editable-input" , ["name" => "title" , "title" => "title", "value" => settings("title")])
                            @include("admin.includes.editable-input" , ["name" => "description" , "title" => "description", "value" => settings("description")])
                            @include("admin.includes.editable-input" , ["name" => "followers_cheap_api_key" , "title" => "Followers cheap api key", "value" => settings("followers_cheap_api_key")])
                        </div>
                        <div class="col-md-6">
                            @include("admin.includes.dropzone" , [
                                    "name" => "logo_path",
                                    "title" => "Logo",
                                    "file_name" => settings("logo_path_name"),
                                    "storage_path" => settings("logo_path_storage_path"),
                                    "public_path" => settings("logo_path_public_path")])
                        </div>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title float-start">
                        {{__('Social Bar')}}
                    </div>
                    <div class="card-tools float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="social_bar_enabled" value="0">
                            <input class="form-check-input" type="checkbox" role="switch"
                                   @checked(settings("social_bar_enabled" , false)) value="1" name="social_bar_enabled"
                                   id="social_bar_enabled">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $socials = ["facebook" , "instagram" , "whatsapp" , "messenger" , "telegram" , "youtube"]
                    @endphp
                    @foreach($socials as $social)
                        @include("admin.includes.editable-input" , ["name" => "social_bar_$social" , "title" => $social, "value" => settings("social_bar_$social")])
                    @endforeach
                </div>
            </div>

            <div class="card ">
                <div class="card-body row">
                    <div class="col-md-12 row">
                        <button class="btn btn-success" type="submit">@lang("Save")</button>
                    </div>
                </div>
            </div>

            {!! html()->form()->close() !!}
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{__('Actions')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-danger"
                               href="{{url("/service/error-log")}}"><i
                                    class="icon-error mr-2"></i> {{__('Error log')}}</a>
                        </div>
                        <div class="col-md-6 my-2"><a class="btn d-block btn-warning"
                                                      href="{{route("admin.settings.activity-log")}}"><i
                                    class="icon-pen2 mr-2"></i> {{__('Activity log')}}</a>
                        </div>
                        <div class="col-md-6 my-2"><a class="btn d-block btn-success"
                                                      href="{{route("admin.settings.clear-cache")}}"><i
                                    class="icon-cached mr-2"></i> {{__('Clear cache')}}</a>
                        </div>
                        <div class="col-md-6 my-2"><a class="btn d-block btn-info"
                                                      href="{{route("admin.settings.backup")}}"><i
                                    class="icon-database mr-2"></i> {{__('Backup')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
