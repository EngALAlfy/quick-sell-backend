<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($customer , 'PUT')->route("tagger.customers.trigger.block" , $customer)->open() !!}
        <div class="row my-3">
            <div class="row my-3">
                @include("includes.multi-lang-textarea",
                [
                    "name" => "status_reason" ,
                    "title" => __('Status Reason'),
                    "hint_icon" => __('Status Reason'),
                    "placeholder" => __('Enter Status Reason') ,
                    "required" => false,
                    "floating" => false,
                    "col" => "12",
                    "classes" => "mb-4 fv-plugins-icon-container",
                ])
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save me-2"></i>
                @if($customer->status == \App\Enums\CustomerStatus::blocked->value)
                    {{ __('Unblock') }}
                @else
                    {{ __('Block') }}
                @endif
            </button>
        </div>
        {!! html()->closeModelForm() !!}
    </div>
</div>
    