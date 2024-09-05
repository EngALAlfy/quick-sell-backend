<div class="mt-4">
    <h6>{{__('Payment Method')}}</h6>
    <div class="d-flex justify-content-between">
        @foreach(\App\Enums\PaymentMethod::values() as $name => $value)
            <button wire:click.prevent="$set('paymentMethod' , '{{$value}}')" @class(["btn",  "w-100", "mx-1" , "btn-light" => $paymentMethod != $value, "btn-primary" => $paymentMethod == $value,])>{{__(\App\Enums\PaymentMethod::tryFrom($value)->getName())}}</button>
        @endforeach
    </div>
</div>
