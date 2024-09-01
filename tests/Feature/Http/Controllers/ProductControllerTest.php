<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Dashboard\ProductController
 */
final class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertViewIs('product.index');
        $response->assertViewHas('products');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('products.create'));

        $response->assertOk();
        $response->assertViewIs('product.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $sku = $this->faker->word();
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $stock_quantity = $this->faker->numberBetween(-10000, 10000);
        $category = Category::factory()->create();

        $response = $this->post(route('products.store'), [
            'name' => $name,
            'sku' => $sku,
            'price' => $price,
            'stock_quantity' => $stock_quantity,
            'category_id' => $category->id,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('sku', $sku)
            ->where('price', $price)
            ->where('stock_quantity', $stock_quantity)
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product));

        $response->assertOk();
        $response->assertViewIs('product.show');
        $response->assertViewHas('product');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertOk();
        $response->assertViewIs('product.edit');
        $response->assertViewHas('product');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $product = Product::factory()->create();
        $name = $this->faker->name();
        $sku = $this->faker->word();
        $price = $this->faker->randomFloat(/** decimal_attributes **/);
        $stock_quantity = $this->faker->numberBetween(-10000, 10000);
        $category = Category::factory()->create();

        $response = $this->put(route('products.update', $product), [
            'name' => $name,
            'sku' => $sku,
            'price' => $price,
            'stock_quantity' => $stock_quantity,
            'category_id' => $category->id,
        ]);

        $product->refresh();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);

        $this->assertEquals($name, $product->name);
        $this->assertEquals($sku, $product->sku);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($stock_quantity, $product->stock_quantity);
        $this->assertEquals($category->id, $product->category_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertModelMissing($product);
    }
}
