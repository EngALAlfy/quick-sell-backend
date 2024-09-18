<div class="row my-3">
    @include('includes.input', [
        'name' => 'quantity',
        'title' => __('Quantity'),
        'required' => true,
        'col' => '12',
        'type' => 'number',
    ])
</div>

<div class="row my-3">
    @include("includes.select",
    [
        "name" => "product_id" ,
        "title" => __('Product') ,
        "hint_icon" => __('Choose the product to add stock') ,
        "placeholder" => __('Please select the product') ,
        "required" => true,
        "floating" => false,
        "options" => $products,
        "col" => "12",
        "classes" => "select2 mb-4 fv-plugins-icon-container",
  ])
</div>
<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{ __('Update Stock') }}</button>
