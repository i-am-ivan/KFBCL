<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'street',
        'city',
        'state',
        'county',
        'gender',
        'national_id',
        'date_of_birth',
        'role',           // This is now a VARCHAR (string) again
        'status',
        'created_by',     // Foreign key to users.id (kept as is)
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relationship: User created by another user (self-referential)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Relationship: User has many logins
     */
    public function logins()
    {
        return $this->hasMany(UserLogin::class, 'user_id', 'id');
    }

    /**
     * Relationship: User has one latest login
     */
    public function latestLogin()
    {
        return $this->hasOne(UserLogin::class, 'user_id', 'id')->latest('logged_in_at');
    }

    /**
     * Get aside view based on role string
     */
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

    /**
     * Check if user can deactivate account
     */
    public function canDeactivateAccount()
    {
        return in_array($this->role, ['Admin', 'Super Admin', 'Treasurer', 'IT']);
    }

    /**
     * Get full name attribute
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
