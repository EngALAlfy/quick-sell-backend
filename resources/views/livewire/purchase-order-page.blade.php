<div class="container mt-5">
    <div class="row">
        <!-- Categories Bar -->
        @include("dashboard.purchase-orders.sections.categories-bar")

        <!-- Current Order -->
        @include("dashboard.purchase-orders.sections.current-order")
    </div>

    @once
        @push('scripts')
            <script>
                document.addEventListener('livewire:init', () => {
                    Livewire.on('order-success', (event) => {
                        toastr.success('{{__('purchase order created successfully')}}' , `{{__('New purchase order #')}}${event.id}`)
                    });

                    Livewire.on('error', (event) => {
                        toastr.error(event.error , `{{__('Error happened')}}`)
                    });

                    $("#supplier_id").on('change' , function (){
                        @this.set('supplier_id' , $this.val());
                    })
                });
            </script>
        @endpush
    @endonce
</div>

