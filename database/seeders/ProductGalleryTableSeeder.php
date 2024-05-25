<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductGalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Gallery = [
            ['product_item_id' => '1', 'image' => '112.jpg'],
            ['product_item_id' => '2', 'image' => '221.jpg'],
            ['product_item_id' => '3', 'image' => '322.jpg'],
            ['product_item_id' => '4', 'image' => '423.jpg'],
            ['product_item_id' => '5', 'image' => '525.jpg'],
            ['product_item_id' => '6', 'image' => '631.jpg'],
            ['product_item_id' => '7', 'image' => '732.jpg'],
            ['product_item_id' => '8', 'image' => '833.jpg'],
            ['product_item_id' => '9', 'image' => '935.jpg'],
            ['product_item_id' => '10', 'image' => '1041.jpg'],
            ['product_item_id' => '11', 'image' => '1142.jpg'],
            ['product_item_id' => '12', 'image' => '1243.jpg'],
            ['product_item_id' => '13', 'image' => '1345.jpg'],
            ['product_item_id' => '14', 'image' => '1451.jpg'],
            ['product_item_id' => '15', 'image' => '1552.jpg'],
            ['product_item_id' => '16', 'image' => '1653.jpg'],
            ['product_item_id' => '17', 'image' => '1755.jpg'],
        ];
        foreach($Gallery as $row)
        {
            DB::table('product_galleries')->insert($row);
        }
    }
}
