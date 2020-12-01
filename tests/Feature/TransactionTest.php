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
        $response = $this->get('/transaction')->assertStatus(302);
    }

    public function test_unathorize_transaction_page_redirect_to_login()
    {
        $response = $this->get('/client')->assertRedirect('/login');
    }

    public function test_admin_user_can_create_transaction()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $attrtibutes = Transaction::factory()->raw();
        $this->post('/transaction', $attrtibutes)->assertRedirect('/transaction');
        $this->assertDatabaseHas('transactions', $attrtibutes);
        $this->get('/transaction')->assertSee($attrtibutes['amount']);
    }
    
    public function test_create_transection_require_fields_validation_check()
    {
        $this->actingAs(User::factory()->create());
        $this->post('/transaction', [])->assertSessionHasErrors(['client_id','transaction_date','amount']);
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


}
