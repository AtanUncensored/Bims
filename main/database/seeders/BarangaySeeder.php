<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barangays')->insert([
            [
                'logo' => 'logo na',
                'barangay_name' => 'Bosongon',
            ],
            [
                'logo' => 'logo na',
                'barangay_name' => 'Talenseras',
            ],
            [
                'logo' => 'logo na',
                'barangay_name' => 'Cabulijan',
            ],
            [
                'logo' => 'logo na',
                'barangay_name' => 'Tinangnan',
            ],
            [
                'logo' => 'logo na',
                'barangay_name' => 'Macaas',
            ]
        ]);
    }
}
