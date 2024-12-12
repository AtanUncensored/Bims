<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateRequest extends Model
{
    use HasFactory;

    protected $table = 'cert_custom'; // Custom table name

    protected $fillable = [
        'user_id',
        'certificate_name',
        'body',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
}
