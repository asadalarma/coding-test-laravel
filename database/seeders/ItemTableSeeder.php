<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        DB::statement( 'SET FOREIGN_KEY_CHECKS=0;' );
		DB::table('items')->truncate();

        for ($i=1; $i <= 100; $i++) { 
        	$costPrice = $faker->randomNumber(2);
            $sellPrice = $costPrice + 2;
            $price = $sellPrice + 2;
            
	        $items[] = [
				  'name' => 'Item '.$i,
                  'description' => $faker->text(),
                  'cost_price' => $costPrice,
                  'sell_price' => $sellPrice,
                  'price' => $price,
                  'quantity' => $faker->randomNumber(2),
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now(),	
			];
        }
        
		DB::table('items')->insert($items);
		DB::statement( 'SET FOREIGN_KEY_CHECKS=1;' );
    }
}
