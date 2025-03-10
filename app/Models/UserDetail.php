<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'zip_code',
        'city',
        'salary',
        'admission_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
