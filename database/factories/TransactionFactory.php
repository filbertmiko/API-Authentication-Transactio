<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\TransactionItem;

class TransactionFactory extends Factory
{
    protected $model = \App\Models\Transaction::class;
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
        
        $total_amount = $this->faker->numberBetween(5, 200);
        $paid_amount = $this->faker->numberBetween($total_amount, $total_amount+5);
        $change_amount = $paid_amount - $total_amount;

        return [
            'user_id' => function(){
                return User::all()->random()['id'];
            },
            'uuid' => Str::uuid()->toString(),
            'device_timestamp' => $this->faker->dateTime($max='now'),
            'total_amount' => $total_amount,
            'paid_amount' => $paid_amount,
            'change_amount' => $change_amount,
            'payment_method' => $this->faker->randomElement(['cash', 'card']),
        ];
    }

}
