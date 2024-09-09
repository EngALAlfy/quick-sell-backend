<tr>
    <td>{{$item->product_name}}</td>
    <td>
        <div class="d-flex align-items-center">
            <button class="btn btn-label-dark btn-sm" wire:click.prevent="updateQuantity({{$item->product_id}} , {{$item->quantity - 1}})">-</button>
            <span class="mx-2">{{$item->quantity}}</span>
            <button class="btn btn-label-dark btn-sm" wire:click.prevent="updateQuantity({{$item->product_id}} , {{$item->quantity + 1}})">+</button>
        </div>
    </td>
    <td>{{$item->price}}</td>
    <td>{{$item->price * $item->quantity}}</td>
    <td><i class="fa fa-close text-danger cursor-pointer" wire:click.prevent="removeItem({{$item->product_id}})"></i></td>
</tr>
