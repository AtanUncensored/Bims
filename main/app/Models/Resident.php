<?php

namespace App\Models;

use App\Models\Purok;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'purok_id', 'birth_date',
        'place_of_birth', 'gender', 'civil_status', 'phone_number', 'citizenship',
        'nickname', 'email', 'current_address', 'permanent_address', 'household_id'
    ];

    public function householdMembers()
    {
        return $this->hasMany(HouseholdMember::class, 'resident_id');
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function purok()
    {
        return $this->belongsTo(Purok::class);
    }   
}
