<div class="row gutters">
    <div class="col-12 d-flex justify-content-center mb-4">
        <div class="avatar" style="width: 12rem;height: 12rem;">
            <img src="{{ $user->getFirstMediaUrl('avatar') }}" alt="{{ $user->name }}" class="rounded shadow">
        </div>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td>@lang('ID')</td>
                    <td>{!! $user->id !!}</td>
                </tr>
                <tr>
                    <td>@lang('Name')</td>
                    <td>{!! $user->name !!}</td>
                </tr>

                <tr>
                    <td>@lang('Email')</td>
                    <td>{!! $user->email !!}</td>
                </tr>

                <tr>
                    <td>@lang('Role')</td>
                    <td>
                        @if ($user->roles->isNotEmpty())
                            {!! getBadgeColumn("{$user->roles->first()->title} ({$user->roles->first()->name})") !!}
                        @else
                            {!! getBadgeColumn() !!}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>@lang('Login method')</td>
                    <td>{!! $user->login_method !!}</td>
                </tr>

                <tr>
                    <td>@lang('Last login OS')</td>
                    <td>{!! $user->last_login_os !!}</td>
                </tr>

                <tr>
                    <td>@lang('Last login at')</td>
                    <td>{!! $user->last_login_datetime !!}</td>
                </tr>

                <tr>
                    <td>@lang('Last login ip')</td>
                    <td>{!! $user->last_login_ip !!}</td>
                </tr>

                <tr>
                    <td>@lang('Last login useragent')</td>
                    <td>{!! $user->last_login_useragent !!}</td>
                </tr>

                <tr>
                    <td>@lang('Created At')</td>
                    <td>{!! $user->created_at !!}</td>
                </tr>

                <tr>
                    <td>@lang('Last update At')</td>
                    <td>{!! $user->updated_at !!}</td>
                </tr>

            </tbody>
        </table>
    </div>
    {{--  todo:: add this   --}}
    <a href="#" class="btn btn-primary"><i class="fa fa-eye me-2"></i>{{ __('View more details') }}</a>
</div>
