<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertUnifast extends Model
{
    use HasFactory;

    protected $table = 'cert_unifasts'; // Name of the table
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected $fillable = [
        'name',
        'user_id',
        'date',
        'address',
        'parent_name',
        'punong_barangay',
        'secretary',
        'treasurer',
        'purpose',
        'age',
        'purok_name'
    ];
}
