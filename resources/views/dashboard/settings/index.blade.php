@extends("layouts.dashboard")

@section("title", __("Settings"))

@section("description", __("Admin system Settings"))

@section("content")
    <div class="row gutters">
        <div class="col-12">
            {!! html()->form()->acceptsFiles()->route("dashboard.settings.store")->open() !!}
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Settings') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            @include("includes.editable-input", ["name" => "title", "title" => __("Title"), "value" => settings("title" , config("app.name"))])
                            @include("includes.editable-input", ["name" => "description", "title" => __("Description"), "value" => settings("description")])
                        </div>
                        <div class="col-md-6">
                            @include("includes.dropzone", [
                                    "name" => "logo_path",
                                    "id" => "logo_path",
                                    "title" => __("Logo"),
                                    "file_name" => settings("logo_path_name"),
                                    "storage_path" => settings("logo_path_storage_path"),
                                    "public_path" => settings("logo_path_public_path")])
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-12 row">
                        <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
            {!! html()->form()->close() !!}
        </div>

        {{-- Development Area --}}
        <div class="col-12">
            <div class="card my-2 mt-5">
                <div class="card-header">
                    <h3>{{ __('Development Area') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-danger" href="{{ url('/error-log') }}">
                                <i class="icon-error mr-2"></i> {{ __('Error Log') }}
                            </a>
                        </div>
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-warning" href="{{ route('dashboard.settings.activity-log') }}">
                                <i class="icon-pen2 mr-2"></i> {{ __('Activity Log') }}
                            </a>
                        </div>

                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-dark" href="{{ route('dashboard.activity') }}">
                                <i class="icon-pen2 mr-2"></i> {{ __('Activity Log 2') }}
                            </a>
                        </div>

                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-info" href="{{ route('dashboard.settings.backup') }}">
                                <i class="icon-database mr-2"></i> {{ __('Backup Manager') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Deployment Area') }}</h3>
                </div>
                <div class="card-body">
                    <p class="text-warning">
                        <i class="icon-warning mr-2"></i> {{ __('These actions may affect the system. Proceed with caution!') }}
                    </p>
                    <p class="text-danger">
                        <i class="icon-info mr-2"></i> {{ __('Make sure you know what you are doing or consult your developer.') }}
                    </p>
                    <p class="text-primary">
                        <i class="icon-bug mr-2"></i> {{ __('These actions should only be performed in local or debug mode.') }}
                    </p>

                    <div class="row justify-content-center">
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-dark" href="{{ route('deploy.clearCache') }}">
                                <i class="icon-cached mr-2"></i> {{ __('Clear Cache') }}
                            </a>
                        </div>
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-success" href="{{ route('deploy.migrate') }}">
                                <i class="icon-database mr-2"></i> {{ __('Migrate') }}
                            </a>
                        </div>
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-warning" href="{{ route('deploy.migrateRefresh') }}">
                                <i class="icon-refresh mr-2"></i> {{ __('Migrate Fresh') }}
                            </a>
                        </div>
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-danger" href="{{ route('deploy.migrateRefreshSeed') }}">
                                <i class="icon-refresh mr-2"></i> {{ __('Migrate Refresh') }}
                            </a>
                        </div>
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-info" href="{{ route('deploy.seed') }}">
                                <i class="icon-seed mr-2"></i> {{ __('Seed') }}
                            </a>
                        </div>
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-secondary" href="{{ route('deploy.storageLink') }}">
                                <i class="icon-link mr-2"></i> {{ __('Storage Link') }}
                            </a>
                        </div>
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-danger" href="{{ route('deploy.down') }}">
                                <i class="icon-offline mr-2"></i> {{ __('Down Mode') }}
                            </a>
                        </div>
                        <div class="col-md-6 my-2">
                            <a class="btn d-block btn-primary" href="{{ route('deploy.up') }}">
                                <i class="icon-online mr-2"></i> {{ __('Up Mode') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
