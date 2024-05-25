<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['color_name' => 'Trắng'],
            ['color_name' => 'Đen'],
            ['color_name' => 'Đỏ'],
            ['color_name' => 'Vàng'],
            ['color_name' => 'Xám'],
            ['color_name' => 'Xanh biển'],
            ['color_name' => 'Vàng'],
            ['color_name' => 'Hồng'],
        ];
        foreach ($colors as $row)
        {
            DB::table('product_colors')->insert($row);
        }
    }
}
