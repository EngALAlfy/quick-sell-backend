<div class="row my-3">
    @include('includes.input', [
        'name' => 'subject',
        'title' => __('Subject'),
        'hint_icon' => __('Ticket subject'),
        'placeholder' => __('Enter Subject'),
        'required' => true,
        'col' => '12',
        'classes' => 'mb-4 fv-plugins-icon-container',
    ])
</div>

<div class="row my-3">
    @include('includes.textarea', [
        'name' => 'description',
        'title' => __('Description'),
        'hint_icon' => __('Ticket Description'),
        'placeholder' => __('Enter Description'),
        'required' => true,
        'col' => '12',
        'classes' => 'mb-4 fv-plugins-icon-container form-control',
    ])
</div>

<div class="row my-3">
    @include('includes.select', [
        'name' => 'status',
        'title' => __('Status'),
        'required' => true,
        'floating' => true,
        'value' => optional(optional($helpTicket ?? null))->first()?->status,
        'options' => \App\Enums\HelpTicketsStatus::values(),
        'col' => '12',
        "classes" => "select2 mb-4 fv-plugins-icon-container",
    ])
</div>



<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{ __('Save Help Ticket') }}</button>
