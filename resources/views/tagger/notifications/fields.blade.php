<div class="row my-3">
    @include("includes.input",
        [
            "name" => "title",
            "title" => __('title'),
            "required" => true,
            "col" => "12",
          ])
</div>

<div class="row my-3">
    @include("includes.textarea",
        [
            "name" => "description",
            "title" => __('description'),
            "required" => true,
            "col" => "12",
          ])
</div>


<div class="row my-3">
    @include("includes.select" ,
        [
            "class" => "store",
            "name" => "store_id",
            "title" => __('Store'),
            "floating" => true,
            "required" => true,
            "value" => $notification->store_id ??'',
            "options" => $stores,
            "col" => "12",
            "classes" => " form-control",
          ])
</div>

<button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>{{__('Save Notification')}}</button>
