<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Dashboard\PurchaseOrderController
 */
final class PurchaseOrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $purchaseOrders = PurchaseOrder::factory()->count(3)->create();

        $response = $this->get(route('purchase-orders.index'));

        $response->assertOk();
        $response->assertViewIs('purchaseOrder.index');
        $response->assertViewHas('purchaseOrders');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('purchase-orders.create'));

        $response->assertOk();
        $response->assertViewIs('purchaseOrder.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\PurchaseOrderController::class,
            'store',
            \App\Http\Requests\PurchaseOrderStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $supplier_id = $this->faker->word();
        $total_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('purchase-orders.store'), [
            'supplier_id' => $supplier_id,
            'total_amount' => $total_amount,
            'status' => $status,
        ]);

        $purchaseOrders = PurchaseOrder::query()
            ->where('supplier_id', $supplier_id)
            ->where('total_amount', $total_amount)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $purchaseOrders);
        $purchaseOrder = $purchaseOrders->first();

        $response->assertRedirect(route('purchaseOrders.index'));
        $response->assertSessionHas('purchaseOrder.id', $purchaseOrder->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();

        $response = $this->get(route('purchase-orders.show', $purchaseOrder));

        $response->assertOk();
        $response->assertViewIs('purchaseOrder.show');
        $response->assertViewHas('purchaseOrder');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();

        $response = $this->get(route('purchase-orders.edit', $purchaseOrder));

        $response->assertOk();
        $response->assertViewIs('purchaseOrder.edit');
        $response->assertViewHas('purchaseOrder');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\PurchaseOrderController::class,
            'update',
            \App\Http\Requests\PurchaseOrderUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();
        $supplier_id = $this->faker->word();
        $total_amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $status = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('purchase-orders.update', $purchaseOrder), [
            'supplier_id' => $supplier_id,
            'total_amount' => $total_amount,
            'status' => $status,
        ]);

        $purchaseOrder->refresh();

        $response->assertRedirect(route('purchaseOrders.index'));
        $response->assertSessionHas('purchaseOrder.id', $purchaseOrder->id);

        $this->assertEquals($supplier_id, $purchaseOrder->supplier_id);
        $this->assertEquals($total_amount, $purchaseOrder->total_amount);
        $this->assertEquals($status, $purchaseOrder->status);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $purchaseOrder = PurchaseOrder::factory()->create();

        $response = $this->delete(route('purchase-orders.destroy', $purchaseOrder));

        $response->assertRedirect(route('purchaseOrders.index'));

        $this->assertModelMissing($purchaseOrder);
    }
}
