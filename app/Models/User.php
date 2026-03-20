<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable  // Change from Users to User, and extend Authenticatable
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

    public function getAsideView()
    {
        $roleAside = [
            'Super Admin' => 'Layouts.SuperAdmin.aside',
            'IT' => 'Layouts.IT.aside',
            'Support' => 'Layouts.Support.aside',
            'Receptionist' => 'Layouts.Receptionist.aside',
            'Chairman' => 'Layouts.Chairman.aside',
            'Treasurer' => 'Layouts.Treasurer.aside',
            'Secretary General' => 'Layouts.SecretaryGeneral.aside',
            'Stage Manager' => 'Layouts.StageManager.aside',
            'Supervisor' => 'Layouts.Supervisor.aside',
        ];

        return $roleAside[$this->role] ?? 'Layouts.Default.aside';
    }
}
