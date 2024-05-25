<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Quản lý'],
            ['name' => 'Nhân viên']
        ];
        foreach($roles as $row)
        {
            DB::table('roles')->insert($row);
        }
    }
}
