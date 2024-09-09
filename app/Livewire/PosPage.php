<?php

namespace App\Livewire;

use App\Enums\PaymentMethod;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Collection;
use Livewire\Component;

class PosPage extends Component
{
    public $categoryId = 0;
    public $paymentMethod;
    public $categories = [];
    public Collection $orderItems;
    public $searchTerm = '';
    public Collection $searchResults;

    public function mount()
    {
        $this->categories = Category::all();
        $this->orderItems = collect();
        $this->searchResults = collect();
        $this->paymentMethod = PaymentMethod::cash->value;;
    }

    public function render()
    {
        $products = Product::query();
        if ($this->categoryId > 0) {
            $products->where('category_id', $this->categoryId);
        }

        return view('livewire.pos-page')->with('products', $products->get());
    }

    public function fetchProducts(): void
    {
        // Check if search term is not empty and query the product model
        if (!empty($this->searchTerm)) {
            $this->searchResults = Product::where('sku', 'like', "%{$this->searchTerm}%")
                ->orWhere('name', 'like', "%{$this->searchTerm}%")
                ->limit(10) // Limit results to avoid showing too many
                ->get();
        } else {
            $this->searchResults = collect([]);
        }
    }

    public function selectProduct($productId): void
    {
        $product = Product::find($productId);

        if ($product) {
            // Add the selected product to the order
            $this->addToOrder($product);
        }else{
            $this->dispatch("error" , error: __("Product not found"));
        }

        // Clear search results after selecting
        $this->searchTerm = '';
        $this->searchResults = collect();
    }

    public function addProductBySearch(): void
    {
        // Same logic as before, to handle when a user directly hits Enter
        if (!empty($this->searchTerm)) {
            $this->selectProduct(
                Product::where('sku', 'like', "%{$this->searchTerm}%")
                    ->orWhere('name', 'like', "%{$this->searchTerm}%")
                    ->value("id")
            );
        }
    }

    public function addToOrder(Product $product): void
    {
        // Look for an existing order item for the product
        $existingItemKey = $this->orderItems->search(function ($item) use ($product) {
            return $item->product_id == $product->id;
        });

        if ($existingItemKey !== false) {
            $this->orderItems[$existingItemKey]->quantity++;
        } else {
            $this->orderItems->push((object)[
                "product_id" => $product->id,
                "product_name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
            ]);
        }

    }

    public function removeItem($productId): void
    {
        $this->orderItems = $this->orderItems->reject(function ($item) use ($productId) {
            return $item->product_id == $productId;
        });
    }

    public function updateQuantity($productId, $quantity): void
    {
        $item = $this->orderItems->firstWhere('product_id', $productId);

        if ($item) {
            $item->quantity = max(1, $quantity); // Ensure the quantity is at least 1
        }
    }

    public function getTotal()
    {
        return $this->orderItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function clearOrder(): void
    {
        $this->orderItems = collect();
    }

    public function placeOrder(): void
    {
        $sale = Sale::create([
            "payment_method" => $this->paymentMethod,
            "total_amount" => $this->getTotal(),
            "user_id" => auth()->id(),
        ]);

        foreach ($this->orderItems as $item) {
            $sale->saleItems()->create([
               "price" => $item->price,
               "product_id" => $item->product_id,
               "quantity" => $item->quantity,
            ]);
        }

        $this->clearOrder();

        $this->dispatch("order-success" , id: $sale->id);
    }
}
