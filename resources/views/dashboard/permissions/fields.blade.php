@include("includes.input",
[
    "name" => "name" ,
    "title" => __('Permission name') ,
    "hint_icon" => __('Permission name must be unique and no spaces') ,
    "placeholder" => __('Enter permission name') ,
    "required" => true,
    "floating" => false,
    "col" => "12",
    "classes" => "mb-4 fv-plugins-icon-container",
  ])

@include("includes.multi-lang-input",
[
    "name" => "title" ,
    "title" => __('Permission title') ,
    "placeholder" => __('Enter permission title') ,
    "required" => true,
    "floating" => false,
    "col" => "12",
    "classes" => "mb-4 fv-plugins-icon-container",
  ])

@include("includes.select",
[
    "name" => "guard_name" ,
    "title" => __('Permission For') ,
    "hint_icon" => __('Choose that for whom this permission') ,
    "placeholder" => __('Please select the guard') ,
    "required" => true,
    "floating" => false,
    "options" => \App\Enums\PermissionsGuard::values(),
    "col" => "12",
    "classes" => "select2 mb-4 fv-plugins-icon-container",
  ])

@include("includes.select",
[
    "name" => "group_id" ,
    "title" => __('Permission Group') ,
    "placeholder" => __('Select permission group') ,
    "required" => true,
    "has_new_item" => true,
    "new_item_attrs" => 'data-bs-dismiss="offcanvas"',
    "new_item_route" => route("admin.permission-groups.create"),
    "floating" => false,
    "options" => $groups,
    "col" => "12",
    "classes" => "select2 mb-4 fv-plugins-icon-container",
  ])

<div class="col-12 text-center mt-5">
    <button type="submit" class="btn btn-primary me-sm-3 me-1"><i class="fa fa-save me-2"></i>{{__('Save permission')}}
    </button>
    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
            aria-label="Close">{{__('Cancel')}}</button>
</div>
