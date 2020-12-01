<?php

namespace Database\Factories;

use App\Models\Transaction;
Use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id'        => Client::factory(),
            'transaction_date' => now(),
            'amount'           => 30,
        ];
    }
}
