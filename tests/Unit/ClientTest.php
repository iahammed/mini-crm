<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Client;
use App\Models\Transaction;
use App\Models\User;


class ClientTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_most_active_clients_are_in_order()
    {
        Transaction::factory(3)->create(['client_id' => Client::factory()->create()]);
        Transaction::factory(2)->create(['client_id' => Client::factory()->create()]);
        Transaction::factory(1)->create(['client_id' => Client::factory()->create()]);
        $mostActiveClient = Client::activity(3)->get();
        $this->assertEquals($mostActiveClient[0]->transactions_count, 3);
        $this->assertEquals($mostActiveClient[1]->transactions_count, 2);
        $this->assertEquals($mostActiveClient[2]->transactions_count, 1);
    }


    
}

