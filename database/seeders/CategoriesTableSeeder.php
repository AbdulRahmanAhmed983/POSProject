<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Cars','Laptops','Technologies'];
        foreach($categories as $category){

            \App\Models\Category::create([
              'ar' => ['name'=>$category],
              'en' => ['name'=>$category],
            ]);
        }
    }
}