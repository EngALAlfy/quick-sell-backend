<div class="navbar-nav align-items-center" wire:init>
    <div class="nav-item d-flex align-items-center position-relative">
        <i class="bx bx-search bx-md"></i>
        <input
                type="text"
                class="form-control border-0 shadow-none ps-1 ps-sm-2"
                placeholder="{{ __('Search...') }}"
                aria-label="Search..."
                wire:model.debounce.300ms="query"
        >

        @if(!empty($results))
            <div class="dropdown-menu show mt-1 w-100" style="max-height: 300px; overflow-y: auto;">
                @foreach($results as $result)
                    <a href="#" class="dropdown-item" wire:click.prevent="selectProduct({{ $result->id }})">
                        {{ $result->name }} (SKU: {{ $result->sku }}) - ${{ $result->sell_price }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
