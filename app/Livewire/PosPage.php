<?php

namespace App\Livewire;

use App\Enums\PaymentMethod;
use App\Enums\ProductStatus;
use App\Enums\TransactionType;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Transaction;
use App\Services\LogService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mockery\Exception;

class PosPage extends Component
{
    public $categoryId = 0;
    public $paymentMethod;
    public $categories = [];
    public $clients = [];
    public Collection $orderItems;
    public $searchTerm = '';
    public Collection $searchResults;

    public function mount()
    {
        $this->categories = Category::whereHas('products', function (Builder $q) {
            $q->where(function (Builder $query) {
                $query->where(function (Builder $subQuery) {
                    $subQuery->where("enable_stock", true)
                        ->where("stock_quantity", ">", 0);
                })->orWhere("enable_stock", false);
            })
                ->where("status", ProductStatus::active->value);
        })->get();

        $this->clients = Client::query()->pluck("name" , "id");

        $this->orderItems = collect();
        $this->searchResults = collect();
        $this->paymentMethod = PaymentMethod::cash->value;
    }

    public function render()
    {
        $products = Product::where(function (Builder $query) {
            $query->where(function (Builder $subQuery) {
                $subQuery->where("enable_stock", true)
                    ->where("stock_quantity", ">", 0);
            })->orWhere("enable_stock", false);
        })
            ->where("status", ProductStatus::active->value);

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
        } else {
            $this->dispatch("error", error: __("Product not found"));
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
            $quantity = $this->orderItems[$existingItemKey]->quantity;
            $stock_quantity = $this->orderItems[$existingItemKey]->stock_quantity;

            if(($quantity + 1) <= $stock_quantity){
                $this->orderItems[$existingItemKey]->quantity++;
            }else{
                $this->dispatch("error", error: __("No stock available"));
            }
        } else {
            if($product->stock_quantity < 1){
                $this->dispatch("error", error: __("No stock available"));
                return;
            }

            $this->orderItems->push((object)[
                "product_id" => $product->id,
                "product_name" => $product->name,
                "stock_quantity" => $product->stock_quantity,
                "quantity" => 1,
                "price" => $product->sell_price,
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
            $stock_quantity = $item->stock_quantity;
            if($quantity <= $stock_quantity){
                $item->quantity = max(1, min($quantity, $stock_quantity));
            }else{
                $this->dispatch("error", error: __("No stock available"));
            }
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
        try {
            DB::beginTransaction();
            $sale = Sale::create([
                "payment_method" => $this->paymentMethod,
                "total_amount" => $this->getTotal(),
            ]);

            foreach ($this->orderItems as $item) {
                $sale->saleItems()->create([
                    "price" => $item->price,
                    "product_id" => $item->product_id,
                    "quantity" => $item->quantity,
                ]);

                $transaction = Transaction::create([
                    "product_id" => $item->product_id,
                    "quantity" => $item->quantity,
                    "amount" => $item->price * $item->quantity,
                    "type" => TransactionType::sell,
                ]);

                $transaction->transactable()->associate($sale);
                $transaction->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            LogService::error("20201", $e, __('Error Happened while new Order'), __FUNCTION__, __CLASS__);
            $this->dispatch("error", error: __("Error Happened while new Order"));
            return;
        }

        $this->clearOrder();
        $this->dispatch("order-success", id: $sale->id);
    }
}
