<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $query = '';
    public $results = [];

    public function fetchProducts(): void
    {
        if (!empty($this->query)) {
            $this->results = Product::where('sku', 'like', "%{$this->query}%")
                ->orWhere('name', 'like', "%{$this->query}%")
                ->limit(10)
                ->get();
        } else {
            $this->results = [];
        }
    }

    public function render()
    {
        return view('livewire.product-search');
    }
}
