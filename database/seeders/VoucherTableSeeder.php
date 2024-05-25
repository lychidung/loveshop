<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $voucher = [
            ['voucher_name' => 'Khuyến mãi 8/3', 'voucher_code' => 'HOAHONG83', 'voucher_type'=>'fixed_amount','value'=>'30000','start_date'=>'2024-03-08','start_time'=>'00:00:00','end_date'=>'2024-12-12','end_time'=>'10:00:00','voucher_min_spend'=>'100000','voucher_max_spend'=>'500000','voucher_use_per_user'=>'100','quantity'=>'100','image'=>'voucher.jpg','status'=>'1'],
            ['voucher_name' => 'Khuyến mãi du xuân đón Tết', 'voucher_code' => 'XUAN2024', 'voucher_type'=>'fixed_amount','value'=>'50000','start_date'=>'2024-01-01', 'start_time'=>'00:00:00','end_date'=>'2024-12-12','end_time'=>'08:00:00','voucher_min_spend'=>'100000','voucher_max_spend'=>'200000','voucher_use_per_user'=>'100','quantity'=>'100','image'=>'voucher.jpg','status'=>'1'],
        ];
        foreach($voucher as $row)
        {
            DB::table('vouchers')->insert($row);
        }
    }
}
