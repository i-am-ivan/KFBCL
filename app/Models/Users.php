<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable  // Changed from Users to User
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'national_id',
        'date_of_birth',
        'role',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function login()
    {
        return $this->hasOne(UserLogin::class);
    }
}
