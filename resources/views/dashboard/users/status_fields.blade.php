<div class="row my-3">
    @include('includes.select', [
        'name' => 'status',
        'title' => __('Status'),
        'required' => true,
        'floating' => true,
        'value' => optional($user)->status,
        'options' => \App\Enums\UserStatus::values(),
        'col' => '12',
        "classes" => "select2 mb-4 fv-plugins-icon-container",
    ])
</div>

<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{ __('Update Status') }}</button>
