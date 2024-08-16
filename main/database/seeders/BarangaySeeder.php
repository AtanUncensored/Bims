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
            ['barangay_name' => 'Bosongon', 'background_image' => 'bosongon.jpg', 'logo' => 'bosongon-logo.jpg'],
            ['barangay_name' => 'Talenseras', 'background_image' => 'talenseras.jpg', 'logo' => 'talenseras-logo.jpg'],
            ['barangay_name' => 'Cabulijan', 'background_image' => 'Cabulijan.png', 'logo' => 'cabulijan-logo.jpg'],
            ['barangay_name' => 'Tinangnan', 'background_image' => 'tinangnan.jpg', 'logo' => 'tinangnan-logo.jpg'],
            ['barangay_name' => 'Macaas', 'background_image' => 'macaas.jpg', 'logo' => 'macaas-logo.jpg']
        ]);
    }
}
