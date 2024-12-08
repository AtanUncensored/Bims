<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'user_id',
        'barangay_id',
        'certificate_type_id',
        'requester_name',
        'purpose',
        'date_needed',
        'or_number',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangay_id');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function certificateType()
    {
        return $this->belongsTo(CertificateType::class, 'certificate_type_id');
    }
}
