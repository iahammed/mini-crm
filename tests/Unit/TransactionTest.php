<?php

namespace Tests\Unit;

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
     * A basic unit test example.
     *
     * @return void
     */
    
    public function test_transactions_cascade_with_client_delete()
    {
        $this->actingAs(User::factory()->create());
        $client = Client::factory()->create();
        $transactions = Transaction::factory()->count(3)->create(['client_id' => $client->id]);
        $this->assertCount(3, Transaction::all());
        $this->delete(route('client.destroy', $client->id));
        $this->assertCount(0, Transaction::all());
    }


}
