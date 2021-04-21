<?php

use Illuminate\Database\Seeder;

class PagarmeSubscriptionTransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date('Y-m-d H:i:s');

        $data=  [
            [
                'user_id' => '2',
                'psychologist_id' => '1',
                'pagarme_subscription_id' => '1',
                'transaction_id' => '11958021',
                'amount' => '85',
                'status' => 'paid',
                'is_active' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        \App\Models\PagarmeSubscriptionTransaction::insert($data);
    }
}
