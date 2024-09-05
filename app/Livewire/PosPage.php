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
    public $paymentMethod = PaymentMethod::cash->value;
    public $categories = [];
    public Collection $orderItems;

    public function mount()
    {
        $this->categories = Category::all();
        $this->orderItems = collect();
    }

    public function render()
    {
        $products = Product::query();
        if ($this->categoryId > 0) {
            $products->where('category_id', $this->categoryId);
        }

        return view('livewire.pos-page')->with('products', $products->get());
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
