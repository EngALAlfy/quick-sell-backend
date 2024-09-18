<div class="mt-4">
    <h6>{{__('Payment Method')}}</h6>
    <div class="d-flex justify-content-between">
        @foreach(\App\Enums\PaymentMethod::values() as $value => $name)
            <button wire:click.prevent="$set('paymentMethod' , '{{$value}}')" @class(["btn",  "w-100", "mx-1" , "btn-light" => $paymentMethod != $value, "btn-primary" => $paymentMethod == $value,])>{{__($value)}}</button>
        @endforeach
    </div>
</div>
