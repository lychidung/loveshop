<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['id_product' => '1' , 'id_color' => '2' , 'price' => '245000', 'discount_price' => '199000'],
            
            ['id_product' => '2' , 'id_color' => '1' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '2' , 'id_color' => '2' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '2' , 'id_color' => '3' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '2' , 'id_color' => '5' , 'price' => '245000', 'discount_price' => '199000'],

            ['id_product' => '3' , 'id_color' => '1' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '3' , 'id_color' => '2' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '3' , 'id_color' => '3' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '3' , 'id_color' => '5' , 'price' => '245000', 'discount_price' => '199000'],

            ['id_product' => '4' , 'id_color' => '1' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '4' , 'id_color' => '2' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '4' , 'id_color' => '3' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '4' , 'id_color' => '5' , 'price' => '245000', 'discount_price' => '199000'],

            ['id_product' => '5' , 'id_color' => '1' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '5' , 'id_color' => '2' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '5' , 'id_color' => '3' , 'price' => '245000', 'discount_price' => '199000'],
            ['id_product' => '5' , 'id_color' => '5' , 'price' => '245000', 'discount_price' => '199000'],

        ];
        foreach ($items as $row)
        {
            DB::table('product_items')->insert($row);
        }
    }
}
