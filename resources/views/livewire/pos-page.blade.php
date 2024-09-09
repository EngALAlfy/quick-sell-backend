<div class="container mt-5">
    <div class="row">
        <!-- Categories Bar -->
        @include("dashboard.sales.sections.categories-bar")

        <!-- Current Order -->
        @include("dashboard.sales.sections.current-order")
    </div>


    @once
        @push('scripts')
            <script>
                document.addEventListener('livewire:init', () => {
                    Livewire.on('order-success', (event) => {
                        toastr.success('{{__('Order created successfully')}}' , `{{__('New Order #')}}${event.id}`)
                    });

                    Livewire.on('error', (event) => {
                        toastr.error(event.error , `{{__('Error happened')}}`)
                    });
                });
            </script>
        @endpush
    @endonce
</div>

