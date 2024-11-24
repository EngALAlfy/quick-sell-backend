<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $this->results = Product::where('name', 'like', '%' . $this->query . '%')
            ->orWhere('sku', 'like', '%' . $this->query . '%')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.product-search');
    }
}
