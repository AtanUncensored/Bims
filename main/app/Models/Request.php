<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resident_id',
        'certificate_type_id',
        'requester_name',
        'purpose',
        'date_needed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function certificateType()
    {
        return $this->belongsTo(CertificateType::class);
    }
    public function certResidency()
    {
        return $this->belongsTo(CertResidency::class, 'resident_id', 'id');
    }
}
