<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Áo cặp đôi cổ tròn', 'description' => 'Áo thun đôi LoveShop là một loại trang phục thời trang được nhiều người yêu thích, đặc biệt là các cặp đôi. Áo thun đôi có nhiều mẫu mã, màu sắc và chất liệu khác nhau, phù hợp với nhiều phong cách và sở thích. Áo thun đôi không chỉ giúp tăng sự gắn kết và thể hiện tình cảm của các cặp đôi, mà còn mang lại sự thoải mái và năng động cho người mặc. Áo thun đôi LoveShop có thể kết hợp với nhiều loại quần áo khác nhau, như quần jeans, quần short, quần jogger, chân váy, … để tạo ra những bộ cánh đẹp mắt và cá tính. Hãy cùng người ấy diện áo thun đôi để tận hưởng những ngày đi du lịch, hẹn hò thật lãng mạng nhé! Sản phẩm có đủ size từ 40kg-85kg. Navy shop cung cấp sỉ và lẻ trên toàn quốc' , 'image' => 'anh.jpg', 'status' => '1'],
            ['category_name' => 'Áo cặp đôi có cổ', 'description' => 'Áo thun đôi LoveShop là một loại trang phục thời trang được nhiều người yêu thích, đặc biệt là các cặp đôi. Áo thun đôi có nhiều mẫu mã, màu sắc và chất liệu khác nhau, phù hợp với nhiều phong cách và sở thích. Áo thun đôi không chỉ giúp tăng sự gắn kết và thể hiện tình cảm của các cặp đôi, mà còn mang lại sự thoải mái và năng động cho người mặc. Áo thun đôi LoveShop có thể kết hợp với nhiều loại quần áo khác nhau, như quần jeans, quần short, quần jogger, chân váy, … để tạo ra những bộ cánh đẹp mắt và cá tính. Hãy cùng người ấy diện áo thun đôi để tận hưởng những ngày đi du lịch, hẹn hò thật lãng mạng nhé! Sản phẩm có đủ size từ 40kg-85kg. Navy shop cung cấp sỉ và lẻ trên toàn quốc', 'image' => 'anh.jpg', 'status' => '1'],
            ['category_name' => 'Áo váy đôi', 'description' => 'Áo thun đôi LoveShop là một loại trang phục thời trang được nhiều người yêu thích, đặc biệt là các cặp đôi. Áo thun đôi có nhiều mẫu mã, màu sắc và chất liệu khác nhau, phù hợp với nhiều phong cách và sở thích. Áo thun đôi không chỉ giúp tăng sự gắn kết và thể hiện tình cảm của các cặp đôi, mà còn mang lại sự thoải mái và năng động cho người mặc. Áo thun đôi LoveShop có thể kết hợp với nhiều loại quần áo khác nhau, như quần jeans, quần short, quần jogger, chân váy, … để tạo ra những bộ cánh đẹp mắt và cá tính. Hãy cùng người ấy diện áo thun đôi để tận hưởng những ngày đi du lịch, hẹn hò thật lãng mạng nhé! Sản phẩm có đủ size từ 40kg-85kg. Navy shop cung cấp sỉ và lẻ trên toàn quốc', 'image' => 'anh.jpg', 'status' => '1'],
            ['category_name' => 'Áo yếm cặp đôi', 'description' => 'Áo thun đôi LoveShop là một loại trang phục thời trang được nhiều người yêu thích, đặc biệt là các cặp đôi. Áo thun đôi có nhiều mẫu mã, màu sắc và chất liệu khác nhau, phù hợp với nhiều phong cách và sở thích. Áo thun đôi không chỉ giúp tăng sự gắn kết và thể hiện tình cảm của các cặp đôi, mà còn mang lại sự thoải mái và năng động cho người mặc. Áo thun đôi LoveShop có thể kết hợp với nhiều loại quần áo khác nhau, như quần jeans, quần short, quần jogger, chân váy, … để tạo ra những bộ cánh đẹp mắt và cá tính. Hãy cùng người ấy diện áo thun đôi để tận hưởng những ngày đi du lịch, hẹn hò thật lãng mạng nhé! Sản phẩm có đủ size từ 40kg-85kg. Navy shop cung cấp sỉ và lẻ trên toàn quốc' , 'image' => 'anh.jpg', 'status' => '1'],
            ['category_name' => 'Nhẫn cặp', 'description' => 'Nhẫn cặp bạc', 'image' => 'anh.jpg', 'status' => '1'],
            ['category_name' => 'Khác', 'description' => 'LoveShop' , 'image' => 'anh.jpg', 'status' => '1'],
        ];
        foreach ($categories as $row)
        {
            DB::table('product_categories')->insert($row);
        }
    }
}
