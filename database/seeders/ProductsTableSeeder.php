<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Products = ['BMW','HP','Technology'];
        foreach($Products as $product){

            \App\Models\Product::create([
                'category_id' => 1,
                'ar' =>['name' => $product ,'description' => $product . 'description'],
                'en' =>['name' => $product ,'description' => $product . 'description'],
                'purchase_price' => 150,
                'sale_price' => 200,
                'stock' => 20,


            ]);
        }
    }
}
