<div class="row my-3">
    @include("includes.multi-lang-input",
    [
        "name" => "title" ,
        "title" => __('title'),
        "hint_icon" => __('Feature Name'),
        "placeholder" => __('Enter Feature Name') ,
        "required" => true,
        "floating" => false,
        "model" => $storeFeature ?? null,
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
        "model" => $storeFeature ?? null,
        "col" => "12",
        "classes" => "mb-4 fv-plugins-icon-container",
    ])
</div>

<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{__('Save Store Feature')}}</button>
