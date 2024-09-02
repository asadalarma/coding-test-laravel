<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {   
        DB::statement( 'SET FOREIGN_KEY_CHECKS=0;' );
        DB::table('orders')->truncate();
		DB::table('order_items')->truncate();

        $customers = User::UserType(User::USER_TYPE_CUSTOMER)->get();

        foreach ($customers as $customer){
            $items = Item::inRandomOrder()->limit(1)->get();

            $totalAmount = $items[0]->quantity * $items[0]->price;
            $deliveryFee = 500;
            $packingFee = 200;
            $grandTotal = $deliveryFee + $packingFee + $totalAmount;

            $orderArr = [
                'user_id' => $customer->id,
                'order_number' => $faker->unique()->randomNumber(5, true),
                'phone' => $customer->phone,
                'address' => $customer->address,
                'status' => 'pending',
                'total_amount' => $totalAmount,
                'delivery_fee' => $deliveryFee,
                'packing_fee' => $packingFee,
                'grand_total' => $grandTotal,
                'payment_method'=> Order::PAYMENT_METHOD_CASH,
                'created_by' => $customer->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $order = $customer->orders()->create($orderArr); 

            foreach ($items as $item) {
                    $order->items()->attach($item->id, [
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ]);
                }
        
        }

		DB::statement( 'SET FOREIGN_KEY_CHECKS=1;' );
    }
}
