<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Dashboard\TransactionController
 */
final class TransactionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $transactions = Transaction::factory()->count(3)->create();

        $response = $this->get(route('transactions.index'));

        $response->assertOk();
        $response->assertViewIs('transaction.index');
        $response->assertViewHas('transactions');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('transactions.create'));

        $response->assertOk();
        $response->assertViewIs('transaction.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\TransactionController::class,
            'store',
            \App\Http\Requests\TransactionStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $transaction_type = $this->faker->randomElement(/** enum_attributes **/);
        $user_id = $this->faker->word();
        $transactable_id = $this->faker->randomNumber();
        $transactable_type = $this->faker->word();
        $amount = $this->faker->randomFloat(/** decimal_attributes **/);

        $response = $this->post(route('transactions.store'), [
            'transaction_type' => $transaction_type,
            'user_id' => $user_id,
            'transactable_id' => $transactable_id,
            'transactable_type' => $transactable_type,
            'amount' => $amount,
        ]);

        $transactions = Transaction::query()
            ->where('transaction_type', $transaction_type)
            ->where('user_id', $user_id)
            ->where('transactable_id', $transactable_id)
            ->where('transactable_type', $transactable_type)
            ->where('amount', $amount)
            ->get();
        $this->assertCount(1, $transactions);
        $transaction = $transactions->first();

        $response->assertRedirect(route('transactions.index'));
        $response->assertSessionHas('transaction.id', $transaction->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $transaction = Transaction::factory()->create();

        $response = $this->get(route('transactions.show', $transaction));

        $response->assertOk();
        $response->assertViewIs('transaction.show');
        $response->assertViewHas('transaction');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $transaction = Transaction::factory()->create();

        $response = $this->get(route('transactions.edit', $transaction));

        $response->assertOk();
        $response->assertViewIs('transaction.edit');
        $response->assertViewHas('transaction');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\TransactionController::class,
            'update',
            \App\Http\Requests\TransactionUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $transaction = Transaction::factory()->create();
        $transaction_type = $this->faker->randomElement(/** enum_attributes **/);
        $user_id = $this->faker->word();
        $transactable_id = $this->faker->randomNumber();
        $transactable_type = $this->faker->word();
        $amount = $this->faker->randomFloat(/** decimal_attributes **/);

        $response = $this->put(route('transactions.update', $transaction), [
            'transaction_type' => $transaction_type,
            'user_id' => $user_id,
            'transactable_id' => $transactable_id,
            'transactable_type' => $transactable_type,
            'amount' => $amount,
        ]);

        $transaction->refresh();

        $response->assertRedirect(route('transactions.index'));
        $response->assertSessionHas('transaction.id', $transaction->id);

        $this->assertEquals($transaction_type, $transaction->transaction_type);
        $this->assertEquals($user_id, $transaction->user_id);
        $this->assertEquals($transactable_id, $transaction->transactable_id);
        $this->assertEquals($transactable_type, $transaction->transactable_type);
        $this->assertEquals($amount, $transaction->amount);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $transaction = Transaction::factory()->create();

        $response = $this->delete(route('transactions.destroy', $transaction));

        $response->assertRedirect(route('transactions.index'));

        $this->assertModelMissing($transaction);
    }
}
