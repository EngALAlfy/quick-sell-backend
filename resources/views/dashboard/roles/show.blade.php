<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td>@lang("Role ID")</td>
                    <td>{!! $role->id !!}</td>
                </tr>
                <tr>
                    <td>@lang("Role name")</td>
                    <td><span class="badge bg-label-hover-danger">{!! $role->name !!}</span></td>
                </tr>

                <tr>
                    <td>@lang("Role title")</td>
                    <td>
                        @foreach(supported_languages() as $lang)
                            <span>{!! $role->getTranslation("title" , $lang) !!}</span>
                            @if($loop->first)
                                <span class="mx-2">-</span>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>@lang("Role guard")</td>
                    <td><span class="badge bg-label-hover-primary">{!! $role->guard_name !!}</span></td>
                </tr>
                <tr>
                    <td>@lang("Permissions")</td>
                    <td>
                        @foreach($role->permissions as $permission)
                            <div>
                                <span>{!! $permission->title !!}</span>
                                <span class="ms-2 badge bg-label-hover-info">{{$permission->name}}</span>
                            </div>
                        @endforeach
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
