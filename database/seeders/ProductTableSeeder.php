<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['id_pro_category' => '1', 'product_name' => 'Áo thun đôi One!', 'description' => 'Chất liệu: Thun Cotton 100%, Form: Rộng Oversize, Sản xuất: Việt Nam', 'status' => '1'],
            ['id_pro_category' => '1', 'product_name' => 'Áo thun đôi You Never Walk Alone', 'description' => 'Chất liệu: Thun Cotton 100%, Form: Rộng Oversize, Sản xuất: Việt Nam', 'status' => '1'],
            ['id_pro_category' => '1', 'product_name' => 'Áo thun đôi Love', 'description' => 'Chất liệu: Thun Cotton 100%, Form: Rộng Oversize, Sản xuất: Việt Nam', 'status' => '1'],
            ['id_pro_category' => '1', 'product_name' => 'Áo thun đôi Angel $ Devil', 'description' => 'Chất liệu: Thun Cotton 100%, Form: Rộng Oversize, Sản xuất: Việt Nam', 'status' => '1'],
            ['id_pro_category' => '1', 'product_name' => 'Áo thun đôi My Only Beats For Him & Her', 'description' => 'Chất liệu: Thun Cotton 100%, Form: Rộng Oversize, Sản xuất: Việt Nam', 'status' => '1'],
        ];
        foreach ($products as $row)
        {
            DB::table('products')->insert($row);
        }
    }
}
