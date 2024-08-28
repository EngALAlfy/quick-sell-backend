<div class="row my-3">
    @include("includes.multi-lang-input",
    [
        "name" => "name" ,
        "title" => __('Name'),
        "hint_icon" => __('Category Name'),
        "placeholder" => __('Enter Category Name') ,
        "required" => true,
        "floating" => false,
        "model" => $category ?? null,
        "col" => "12",
        "classes" => "mb-4 fv-plugins-icon-container",
    ])
</div>

<div class="row my-3">
    @include("includes.multi-lang-textarea",
    [
        "name" => "description" ,
        "title" => __('Description'),
        "hint_icon" => __('Category Description'),
        "placeholder" => __('Enter Category Description') ,
        "required" => false,
        "floating" => false,
        "model" => $category ?? null,
        "col" => "12",
        "classes" => "mb-4 fv-plugins-icon-container",
    ])
</div>

<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{__('Save Category')}}</button>
