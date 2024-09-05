<div class="row my-3">
    @include('includes.input', [
        'name' => 'name',
        'title' => __('Name'),
        'required' => true,
        'col' => '12',
        'value' => old('name', isset($sale) ? $sale->name : ''),
    ])
</div>

<div class="row my-3">
    @include('includes.textarea', [
        'name' => 'description',
        'title' => __('Description'),
        'required' => false,
        'col' => '12',
        'value' => old('description', isset($sale) ? $sale->description : ''),
    ])
</div>

<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{ __('Save Sale') }}</button>
