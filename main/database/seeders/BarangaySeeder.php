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
            ['barangay_name' => 'Bosongon', 'background_image' => 'bosongon.jpg', 'address' => 'Brgy. Bosongon, Tubigon, Bohol' ,'logo' => 'bosongon-logo.jpg'],
            ['barangay_name' => 'Talenceras', 'background_image' => 'talenceras.jpg', 'address' => 'Brgy. Talenceras, Tubigon, Bohol', 'logo' => 'talenceras-logo.jpg'],
            ['barangay_name' => 'Cabulijan', 'background_image' => 'Cabulijan.png', 'address' => 'Brgy. Cabulijan, Tubigon, Bohol' , 'logo' => 'cabulijan-logo.jpg'],
            ['barangay_name' => 'Tinangnan', 'background_image' => 'tinangnan.jpg', 'address' => 'Brgy. Tinangnan, Tubigon, Bohol', 'logo' => 'tinangnan-logo.jpg'],
        ]);
    }
}
