<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'purok',
        'birth_date',
        'place_of_birth',
        'gender',
        'civil_status',
        'phone_number',
        'citizenship',
        'nickname',
        'email',
        'current_address',
        'permanent_address',
        'barangay_id',  // Make sure to include the barangay_id as well
    ];
    
    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
}
