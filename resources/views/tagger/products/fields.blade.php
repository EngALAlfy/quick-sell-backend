<div class="row my-3">
    @include("includes.multi-lang-input",
    [
        "name" => "name" ,
        "title" => __('Name'),
        "hint_icon" => __('Product Name'),
        "placeholder" => __('Enter Product Name') ,
        "required" => true,
        "floating" => false,
        "model" => $product ?? null,
        "col" => "12",
        "classes" => "mb-4 fv-plugins-icon-container",
    ])
</div>

<div class="row my-3">
    @include("includes.multi-lang-textarea",
    [
        "name" => "description" ,
        "title" => __('Description'),
        "hint_icon" => __('Product Description'),
        "placeholder" => __('Enter Product Description') ,
        "required" => true,
        "floating" => false,
        "model" => $product ?? null,
        "col" => "12",
        "classes" => "mb-4 fv-plugins-icon-container",
    ])
</div>

<div class="row my-3">
    @include("includes.input",
    [
        "name" => "price",
        "title" => __('Price'),
        "type" => "number",
        "required" => true,
        "col" => "12",
    ])
</div>

<div class="row my-3">
    @include("includes.input",
    [
        "name" => "discount_percentage",
        "title" => __('Discount Percentage'),
        "type" => "number",
        "required" => false,
        "col" => "12",
    ])
</div>

<div class="row my-3">
    @include("includes.input",
    [
        "name" => "quantity",
        "title" => __('Quantity'),
        "type" => "number",
        "required" => true,
        "col" => "12",
    ])
</div>

<div class="row my-3">
    @include("includes.input",
    [
        "name" => "max_quantity",
        "title" => __('Max Quantity'),
        "type" => "number",
        "required" => false,
        "col" => "12",
    ])
</div>

<div class="row my-3">
    @include("includes.input",
    [
        "name" => "min_quantity",
        "title" => __('Min Quantity'),
        "type" => "number",
        "required" => false,
        "col" => "12",
    ])
</div>

<div class="row my-3">
    @include("includes.select",
    [
        "name" => "category_id",
        "title" => __('Category'),
        "required" => true,
        "floating" => true,
        "value" => optional($product ?? null)->category,
        "options" => $categories,
        "col" => "12",
        "classes" => "select2 mb-4 fv-plugins-icon-container",
    ])
</div>

<div class="row my-3">
    <label class="form-label" for="image">
        {{__("Main Image")}}
    </label>
    @include("includes.dropzone" , [
        "name" => "image",
        "title" => __('Image'),
        "size" => isset($product) ? optional($product)->getFirstMedia('image')?->size: null,
        "file_name" => isset($product) ? optional($product)->getFirstMedia('image')?->file_name: null,
        "storage_path" => isset($product) ? optional($product)->getFirstMedia('image')?->id: null,
        "public_path" => isset($product) ? optional($product)->getFirstMedia('image')?->getUrl(): null
    ])
</div>

<div class="row my-3">
    <label class="form-label">
        {{__("Gallery")}}
    </label>

    @include("includes.dropzone" , [
        "name" => "gallery",
        "id" => "galleryDropzone",
        "maxFiles" => 10,
        "size" => isset($product) ? optional($product)->getMedia('gallery')?->pluck('size')?->toArray(): null,
        "file_name" => isset($product) ? optional($product)->getMedia('gallery')?->pluck('file_name')?->toArray(): null,
        "storage_path" => isset($product) ? optional($product)->getMedia('gallery')?->pluck('id')?->toArray(): null,
        "public_path" => isset($product) ? optional($product)->getMedia('gallery')?->map(fn($item) => $item->getUrl())?->toArray(): null
    ])
</div>

<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{__('Save Product')}}</button>
