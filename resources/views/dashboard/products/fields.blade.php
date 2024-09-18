<div class="row my-3">
    @include('includes.input', [
        'name' => 'name',
        'title' => __('Name'),
        'required' => true,
        'col' => '12',
    ])
</div>

<div class="row my-3">
    @include('includes.textarea', [
        'name' => 'description',
        'title' => __('Description'),
        'required' => false,
        'col' => '12',
    ])
</div>

<div class="row my-3">
    @include('includes.input', [
        'name' => 'purchase_price',
        'title' => __('Purchase price'),
        'type' => 'number',
        'required' => true,
        'attrs' => [
            'step' => '0.01',
        ],
        'col' => '6',
    ])

    @include('includes.input', [
        'name' => 'sell_price',
        'title' => __('Sell price'),
        'type' => 'number',
        'required' => true,
        'attrs' => [
            'step' => '0.01',
        ],
        'col' => '6',
    ])
</div>

@if(!isset($product))
    <div class="row my-3">
        @include('includes.input', [
            'name' => 'stock_quantity',
            'title' => __('Stock quantity'),
            'type' => 'number',
            'required' => true,
            'col' => '12',
        ])
    </div>
@endif

<div class="row my-3">
    @include('includes.input', [
        'name' => 'sku',
        'title' => __('Sku '),
        'required' => false,
        'col' => '12',
    ])
</div>

<div class="row my-3">
    @include('includes.select', [
        'name' => 'category_id',
        'title' => __('Category'),
        'required' => true,
        'options' => $categories,
        'col' => '12',
        "classes" => "select2 mb-4 fv-plugins-icon-container",
    ])
</div>

<div class="row my-3">
    @include('includes.dropzone', [
        'name' => 'image',
        'title' => __('Product Image'),
        'size' => isset($product) ? optional($product->getFirstMedia('image'))->size : null,
        'file_name' => isset($product) ? optional($product->getFirstMedia('image'))->file_name : null,
        'storage_path' => isset($product) ? optional($product->getFirstMedia('image'))->id : null,
        'public_path' => isset($product) ? optional($product->getFirstMedia('image'))->getUrl() : null,
    ])
</div>

<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{ __('Save Product') }}</button>
