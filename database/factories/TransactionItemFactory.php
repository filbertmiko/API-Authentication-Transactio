<?php

namespace Database\Factories;

use App\Models\TransactionItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
Use App\Models\Transaction;

class TransactionItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'qty' => $this->faker->randomDigit(),
            'price' => $this->faker->numberBetween(0,200),
            'uuid' => Str::uuid()->toString(),
            'transaction_id' => function(){
                return Transaction::all()->random()['id'];
            }
        ];
    }

}
