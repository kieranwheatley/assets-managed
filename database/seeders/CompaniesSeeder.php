<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'name' => 'Assets Managed',
            ],
            [
                'name' => 'Apple',
            ],
            [
                'name' => 'Dell',
            ],
            [
                'name' => 'Microsoft',
            ],
            [
                'name' => 'Samsung',
            ],
            [
                'name' => 'Sony',
            ],
            [
                'name' => 'Toshiba',
            ],
            [
                'name' => 'Xiaomi',
            ],
            [
                'name' => 'Hewlett-Packard',
            ],
        ]);
    }
}
