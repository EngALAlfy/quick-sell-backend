<div class="row my-3">
    @include('includes.input', [
        'name' => 'name',
        'title' => __('Name'),
        'type' => 'text',
        'required' => true,
        'col' => '12',
    ])
</div>
<div class="row my-3">
    @include('includes.input', [
        'name' => 'title',
        'title' => __('Title'),
        'required' => true,
        'col' => '12',
    ])
</div>

<div class="row my-3">
    @include('includes.textarea', [
        'name' => 'content',
        'title' => __('Content'),
        'type' => 'text',
        'required' => true,
        'col' => '12',
    ])
</div>


<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>Save page</button>
