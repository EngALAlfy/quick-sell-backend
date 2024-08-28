<div class="row my-3">
    @include('includes.input', [
        'name' => 'title',
        'title' => __('Title'),
        'hint_icon' => __('Title of the tag'),
        'placeholder' => __('Enter tag title'),
        'required' => true,
        'col' => '12',
        'classes' => 'mb-4 fv-plugins-icon-container form-control',
    ])
</div>


<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{ __('Save Tag') }}</button>
