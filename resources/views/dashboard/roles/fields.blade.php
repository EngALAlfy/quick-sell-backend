@include("includes.input",
[
    "name" => "name" ,
    "title" => __('Role name') ,
    "placeholder" => __('Enter role name') ,
    "required" => true,
    "floating" => false,
    "col" => "12",
    "classes" => "mb-4 fv-plugins-icon-container",
  ])

@include("includes.multi-lang-input",
[
    "name" => "title" ,
    "title" => __('Role title'),
    "hint_icon" => __('Role title will appear in the UI'),
    "placeholder" => __('Enter role title') ,
    "required" => true,
    "floating" => false,
    "model" => $role ?? null,
    "col" => "12",
    "classes" => "mb-4 fv-plugins-icon-container",
  ])

@include("includes.input",
[
    "name" => "level" ,
    "title" => __('Role level'),
    "placeholder" => __('Enter role level') ,
    "required" => true,
    "floating" => false,
    "type" => 'number',
    "col" => "12",
    "classes" => "mb-4 fv-plugins-icon-container",
  ])

@include("includes.select",
[
    "name" => "guard_name" ,
    "title" => __('Role For') ,
    "hint_icon" => __('Choose that for whom this role') ,
    "placeholder" => __('Please select the guard') ,
    "required" => true,
    "floating" => false,
    "options" => \App\Enums\PermissionsGuard::values(),
    "col" => "12",
    "classes" => "select2 mb-4 fv-plugins-icon-container",
  ])

<div class="col-12">
    <div class="d-flex justify-content-between">
        <h4>{{__('Role Permissions')}}</h4>
        {!! ajax_button("<i class='fa fa-plus me-2'></i>" . __('Add new permission'), "btn btn-sm text-nowrap" , route("dashboard.permissions.create") , __('Add new permission')  , 'data-bs-dismiss="modal"' , "offcanvas") !!}
    </div>
    <!-- Permission table -->
    <div class="table-responsive">
        <table class="table table-flush-spacing">
            <tbody>
            <tr>
                <td class="text-nowrap fw-medium">{{__('Administrator Access')}} {!! hint_icon(__('Allows a full access to the system')) !!}</td>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label" for="selectAll">
                            {{__('Select All')}}
                        </label>
                    </div>
                </td>
            </tr>
            @foreach($groups as $group)
                <tr>
                    <td class="text-nowrap fw-medium">{{$group->name}}</td>
                    <td>
                        <div class="d-flex">
                            @foreach($group->permissions as $permission)
                                <div class="form-check me-3 me-lg-5">
                                    <input class="form-check-input"
                                           @checked(optional($role ?? null)->hasPermissionTo($permission)) name="permissions[]"
                                           value="{{$permission->id}}" type="checkbox"
                                           id="permission_{{$permission->id}}">
                                    <label class="form-check-label" for="permission_{{$permission->id}}">
                                        {{$permission->title}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Permission table -->
</div>

<div class="col-12 text-center mt-3">
    <button type="submit" class="btn btn-primary me-sm-3 me-1"><i class="fa fa-save me-2"></i>{{__('Save role')}}
    </button>
    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
            aria-label="Close">{{__('Cancel')}}</button>
</div>
