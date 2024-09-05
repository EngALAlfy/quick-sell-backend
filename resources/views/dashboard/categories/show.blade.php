<div class="row gutters">
    <div class="col-12 d-flex justify-content-center mb-4">
        <div class="avatar" style="width: 12rem;height: 12rem;">
            <img src="{{ $admin->getFirstMediaUrl('avatar') }}" alt="{{ $admin->name }}" class="rounded shadow">
        </div>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td>@lang('ID')</td>
                    <td>{!! $admin->id !!}</td>
                </tr>
                <tr>
                    <td>@lang('Name')</td>
                    <td>{!! $admin->name !!}</td>
                </tr>

                <tr>
                    <td>@lang('Email')</td>
                    <td>{!! $admin->email !!}</td>
                </tr>

                <tr>
                    <td>@lang('Role')</td>
                    <td>
                        @if ($admin->roles->isNotEmpty())
                            {!! getBadgeColumn("{$admin->roles->first()->title} ({$admin->roles->first()->name})") !!}
                        @else
                            {!! getBadgeColumn() !!}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>@lang('Login method')</td>
                    <td>{!! $admin->login_method !!}</td>
                </tr>

                <tr>
                    <td>@lang('Last login OS')</td>
                    <td>{!! $admin->last_login_os !!}</td>
                </tr>

                <tr>
                    <td>@lang('Last login at')</td>
                    <td>{!! $admin->last_login_datetime !!}</td>
                </tr>

                <tr>
                    <td>@lang('Last login ip')</td>
                    <td>{!! $admin->last_login_ip !!}</td>
                </tr>

                <tr>
                    <td>@lang('Last login useragent')</td>
                    <td>{!! $admin->last_login_useragent !!}</td>
                </tr>

                <tr>
                    <td>@lang('Created At')</td>
                    <td>{!! $admin->created_at !!}</td>
                </tr>

                <tr>
                    <td>@lang('Last update At')</td>
                    <td>{!! $admin->updated_at !!}</td>
                </tr>

            </tbody>
        </table>
    </div>
    {{--  todo:: add this   --}}
    <a href="#" class="btn btn-primary"><i class="fa fa-eye me-2"></i>{{ __('View more details') }}</a>
</div>
