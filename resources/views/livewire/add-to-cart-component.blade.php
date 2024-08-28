<div>
    @if($type == 'button')
        <button type="button" class="s-button-element s-button-btn s-button-solid s-button-wide s-button-primary s-button-loader-center" wire:click.stop="addToCart">
            <span class="s-button-text">{{__('Add to cart')}}</span>
        </button>
    @elseif ($type == 'grid')
        <div class="btn btn--floated btn--add-to-cart" wire:click.stop="addToCart">
            <i class="sicon-shopping-bag"></i>
        </div>
    @endif

    @once
        @push('scripts')
            <script>
                document.addEventListener('livewire:init', () => {
                    Livewire.on('error-happend', (event) => {
                        Swal.fire({
                            title: event.message,
                            text: event.message,
                            icon: "error"
                        });
                    });

                    Livewire.on('added-to-cart', (event) => {
                        $(".s-cart-summary-count").text(event.count);
                        $(".s-cart-summary-total").text(event.total);
                        Swal.fire({
                            title: event.message,
                            text: event.message,
                            icon: "success"
                        });
                    });
                });
            </script>
        @endpush
    @endonce

</div>
