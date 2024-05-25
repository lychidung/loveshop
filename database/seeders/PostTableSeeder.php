<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = [
            ['id_user' => '1', 'title' => 'Làm thế nào để mua sắm tại LoveShop', 'body' => 'Truy cập vào website loveshop', 'image' => 'anhdep.png','status' => '1']
        ];
        foreach($post as $row)
        {
            DB::table('posts')->insert($row);
        }
    }
}
