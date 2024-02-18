<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentList = ['Credit Card', 'COD', 'Debit Card', 'GoPay', 'OVO'];
        for($i = 0; $i < count($paymentList); $i++){
            Payment::create([
                'name' => $paymentList[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
