<div class="row my-3">
    @include('includes.input', [
        'name' => 'name',
        'title' => __('name'),
        'required' => true,
        'col' => '12',
    ])
</div>

<div class="row my-3">
    @include('includes.input', [
        'name' => 'email',
        'title' => __('Email'),
        'required' => true,
        'col' => '12',
    ])
</div>

<div class="row my-3">
    @include('includes.input', [
        'name' => '_password',
        'title' => __('Password'),
        'type' => 'password',
        'required' => false,
        'value' => '',
        'col' => '12',
        'attrs' => [
            'autocomplete' => 'new-password',
        ],
    ])
</div>


<div class="row my-3">
    @include('includes.select', [
        'name' => 'role',
        'title' => __('Role'),
        'required' => true,
        'floating' => true,
        'value' => optional(optional($user ?? null)->getRoleNames())->first(),
        'options' => $roles,
        'col' => '12',
        "classes" => "select2 mb-4 fv-plugins-icon-container",
    ])
</div>
<div class="form-group my-3">
    @include('includes.dropzone', [
        'name' => 'avatar',
        'title' => __('Avatar'),
        'size' => isset($user) ? optional($user)->getFirstMedia('avatar')?->size : null,
        'file_name' => isset($user) ? optional($user)->getFirstMedia('avatar')?->file_name : null,
        'storage_path' => isset($user) ? optional($user)->getFirstMedia('avatar')?->id : null,
        'public_path' => isset($user) ? optional($user)->getFirstMedia('avatar')?->getUrl() : null,
    ])
</div>

<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{ __('Save user') }}</button>
