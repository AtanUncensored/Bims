<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CertificateType;

class CertificateTypeSeeder extends Seeder
{
    public function run(): void
    {
        CertificateType::create([
            'certificate_name' => 'Residency Certificate',
            'price' => 100.00,
            'table_name' => 'cert_residences',
        ]);

        CertificateType::create([
            'certificate_name' => 'Job Seeker Certificate',
            'price' => 150.00,
            'table_name' => 'cert_job_seekers',
        ]);

        CertificateType::create([
            'certificate_name' => 'Indigency Certificate',
            'price' => 200.00,
            'table_name' => 'cert_indigencies',
        ]);
        
    }
}
