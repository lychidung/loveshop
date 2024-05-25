<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariationSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $VarSizes = [
            ['id_product_item' => '1', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '2', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '2', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '2', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '2', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '3', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '3', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '3', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '3', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '4', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '4', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '4', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '4', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '5', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '5', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '5', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '5', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '6', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '6', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '6', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '6', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '7', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '7', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '7', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '7', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '8', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '8', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '8', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '8', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '9', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '9', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '9', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '9', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '10', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '10', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '10', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '10', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '11', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '11', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '11', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '11', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '12', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '12', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '12', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '12', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '13', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '13', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '13', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '13', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '14', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '14', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '14', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '14', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '15', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '15', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '15', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '15', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '16', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '16', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '16', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '16', 'id_size' => '4', 'in_stock' => '10'],

            ['id_product_item' => '17', 'id_size' => '1', 'in_stock' => '20'],
            ['id_product_item' => '17', 'id_size' => '2', 'in_stock' => '30'],
            ['id_product_item' => '17', 'id_size' => '3', 'in_stock' => '40'],
            ['id_product_item' => '17', 'id_size' => '4', 'in_stock' => '10'],
        ];
        foreach($VarSizes as $row)
        {
            DB::table('product_variation_sizes')->insert($row);
        }
    }
}
