<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Client;
use App\Models\Transaction;
use App\Models\User;

class TransactionTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth_check_transaction_page()
    {
        $response = $this->get(route('transaction.index'))->assertStatus(302);
    }

    public function test_unathorize_transaction_page_redirect_to_login()
    {
        $response = $this->get(route('client.index'))->assertRedirect(route('login'));
    }

    public function test_admin_user_can_create_transaction()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $attrtibutes = Transaction::factory()->raw();
        $this->post(route('transaction.store'), $attrtibutes)
                ->assertRedirect(route('transaction.index'));
        $this->assertDatabaseHas('transactions', $attrtibutes);
    }
    
    public function test_create_transection_require_fields_validation_check()
    {
        $this->actingAs(User::factory()->create());
        $this->post(route('transaction.store'), [])->assertSessionHasErrors(['client_id','transaction_date','amount']);
    }

    public function test_create_transection_amount_fields_must_be_numeric_validation_check()
    {
        $this->actingAs(User::factory()->create());
        $this->post(route('transaction.store'), Transaction::factory()->raw(['amount' => 'xyz']))->assertSessionHasErrors(['amount']);
    }
    
    public function test_admin_can_view_transaction_detail()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $transaction = Transaction::factory()->create();
        $this->get($transaction->path())
                ->assertSee($transaction->client_id)
                ->assertSee($transaction->transaction_date)
                ->assertSee($transaction->amount);
    }

    public function test_admin_may_update_clients_transactions()
    {
        $this->actingAs(User::factory()->create());
        $transaction = Transaction::factory()->create();

        $this->put(route('transaction.update', $transaction->id), [
            'client_id'         => $transaction->client_id,
            'transaction_date'  => $transaction->transaction_date,
            'amount' =>  10
        ]);
        $this->assertEquals(10, Transaction::first()->amount);
    }

    public function test_auth_admin_can_delete_a_transaction()
    {
        $this->actingAs(User::factory()->create());
        $attrtibutes = Transaction::factory()->raw();
        $this->post(route('transaction.store'), $attrtibutes);
        $trans = Client::firstOrFail();
        $this->assertCount(1, Transaction::all());
        $this->delete(route('transaction.destroy', $trans->id));
        $this->assertCount(0, Transaction::all());
    }
    
    public function test_client_should_not_allow_to_wthdraw_more_than_the_current_balance()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        // Create a Client To make sure of same client is in next four operation 
        $client = Client::factory()->create();
        Transaction::factory(3)->create(['client_id' => $client->id]);
        $attrtibutes = [
            'client_id'         => $client->id,
            'transaction_date'  => now(),
            'amount'            => 90.01,
            'submit'            => 'Withdraw' 
        ];
        $this->post('/transaction', $attrtibutes)->assertSessionHasErrors('amount');;
    }

}
