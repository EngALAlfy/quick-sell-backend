<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Dashboard\SaleController
 */
final class SaleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $sales = Sale::factory()->count(3)->create();

        $response = $this->get(route('sales.index'));

        $response->assertOk();
        $response->assertViewIs('sale.index');
        $response->assertViewHas('sales');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('sales.create'));

        $response->assertOk();
        $response->assertViewIs('sale.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\SaleController::class,
            'store',
            \App\Http\Requests\SaleStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user_id = $this->faker->word();
        $total_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $payment_method = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('sales.store'), [
            'user_id' => $user_id,
            'total_amount' => $total_amount,
            'payment_method' => $payment_method,
        ]);

        $sales = Sale::query()
            ->where('user_id', $user_id)
            ->where('total_amount', $total_amount)
            ->where('payment_method', $payment_method)
            ->get();
        $this->assertCount(1, $sales);
        $sale = $sales->first();

        $response->assertRedirect(route('sales.index'));
        $response->assertSessionHas('sale.id', $sale->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $sale = Sale::factory()->create();

        $response = $this->get(route('sales.show', $sale));

        $response->assertOk();
        $response->assertViewIs('sale.show');
        $response->assertViewHas('sale');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $sale = Sale::factory()->create();

        $response = $this->get(route('sales.edit', $sale));

        $response->assertOk();
        $response->assertViewIs('sale.edit');
        $response->assertViewHas('sale');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\SaleController::class,
            'update',
            \App\Http\Requests\SaleUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $sale = Sale::factory()->create();
        $user_id = $this->faker->word();
        $total_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $payment_method = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('sales.update', $sale), [
            'user_id' => $user_id,
            'total_amount' => $total_amount,
            'payment_method' => $payment_method,
        ]);

        $sale->refresh();

        $response->assertRedirect(route('sales.index'));
        $response->assertSessionHas('sale.id', $sale->id);

        $this->assertEquals($user_id, $sale->user_id);
        $this->assertEquals($total_amount, $sale->total_amount);
        $this->assertEquals($payment_method, $sale->payment_method);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $sale = Sale::factory()->create();

        $response = $this->delete(route('sales.destroy', $sale));

        $response->assertRedirect(route('sales.index'));

        $this->assertModelMissing($sale);
    }
}
