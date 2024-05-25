<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'Chí Dũng', 'password' => '12345', 'phone' => '0909135130', 'email' => '2154810045@vaa.edu', 'point' => '150', 'birthday' => '2004-12-06','address' =>' Số 8, Phạm Thế Hiển, P6, Quận 5, TP.HCM', 'gender' => '1', 'image'=>'dung.png' ,'status' => '1']
        ];
        foreach($customers as $row)
        {
            DB::table('customers')->insert($row);
        }
    }
}
