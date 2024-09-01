<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Dashboard\StockController
 */
final class StockControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $stocks = Stock::factory()->count(3)->create();

        $response = $this->get(route('stocks.index'));

        $response->assertOk();
        $response->assertViewIs('stock.index');
        $response->assertViewHas('stocks');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('stocks.create'));

        $response->assertOk();
        $response->assertViewIs('stock.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\StockController::class,
            'store',
            \App\Http\Requests\StockStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $product_id = $this->faker->word();
        $quantity = $this->faker->numberBetween(-10000, 10000);
        $type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('stocks.store'), [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'type' => $type,
        ]);

        $stocks = Stock::query()
            ->where('product_id', $product_id)
            ->where('quantity', $quantity)
            ->where('type', $type)
            ->get();
        $this->assertCount(1, $stocks);
        $stock = $stocks->first();

        $response->assertRedirect(route('stocks.index'));
        $response->assertSessionHas('stock.id', $stock->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $stock = Stock::factory()->create();

        $response = $this->get(route('stocks.show', $stock));

        $response->assertOk();
        $response->assertViewIs('stock.show');
        $response->assertViewHas('stock');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $stock = Stock::factory()->create();

        $response = $this->get(route('stocks.edit', $stock));

        $response->assertOk();
        $response->assertViewIs('stock.edit');
        $response->assertViewHas('stock');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\StockController::class,
            'update',
            \App\Http\Requests\StockUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $stock = Stock::factory()->create();
        $product_id = $this->faker->word();
        $quantity = $this->faker->numberBetween(-10000, 10000);
        $type = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('stocks.update', $stock), [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'type' => $type,
        ]);

        $stock->refresh();

        $response->assertRedirect(route('stocks.index'));
        $response->assertSessionHas('stock.id', $stock->id);

        $this->assertEquals($product_id, $stock->product_id);
        $this->assertEquals($quantity, $stock->quantity);
        $this->assertEquals($type, $stock->type);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $stock = Stock::factory()->create();

        $response = $this->delete(route('stocks.destroy', $stock));

        $response->assertRedirect(route('stocks.index'));

        $this->assertModelMissing($stock);
    }
}
