<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Transaction;
use \App\Models\TransactionItem;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::factory()->count(10)->create()->each(function ($transaction) {
            TransactionItem::factory()->count(5)->create()->make()->toArray();
        });
    }
}
