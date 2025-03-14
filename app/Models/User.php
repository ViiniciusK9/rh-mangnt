<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'role',
        'permissions',
        'confirmation_token',
        'email_verified_at',
    ];

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
