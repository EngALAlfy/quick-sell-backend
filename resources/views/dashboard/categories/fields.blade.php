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

<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{ __('Save Category') }}</button>
