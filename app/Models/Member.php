<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'memberId';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'member_number', 'firstname', 'lastname', 'email', 'phone1', 'phone2', 'gender', 'dob', 'author', 'membership', 'status'
    ];

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = ['full_name', 'age'];

    /**
     * Boot method to auto-set author on creation
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check() && !$model->author) {
                $model->author = Auth::id();
            }
        });
    }

    // Check Member profile Status
    public function isProfileActive()
    {
        return $this->status === 'Active';
    }

    public function isProfileNotActive()
    {
        return $this->status === 'In-Active';
    }

    public function isSuspended()
    {
        return $this->status === 'Suspended';
    }

    public function identification()
    {
        return $this->hasOne(MemberIdentification::class, 'member_id', 'memberId');
    }

    public function kins()
    {
        return $this->hasMany(MemberKin::class, 'member', 'memberId');
    }

    public function vehicles()
    {
        return $this->hasMany(MemberVehicle::class, 'member', 'memberId');
    }

    public function stagesManaged()
    {
        return $this->hasMany(Stage::class, 'manager', 'memberId');
    }

    public function latestTransaction()
    {
        return $this->hasOne(MemberTransaction::class, 'member', 'memberId')
                    ->latest('transaction_date');
    }

    public function transactions()
    {
        return $this->hasMany(MemberTransaction::class, 'member', 'memberId');
    }

    /**
     * Get the member's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Get the member's age based on date of birth.
     */
    public function getAgeAttribute()
    {
        return $this->dob ? \Carbon\Carbon::parse($this->dob)->age : null;
    }

    /**
     * Relationship: User who created/updated this member (using author)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    /**
     * Get the member's most recent confirmed paid‑in contribution.
     */
    public function latestContribution()
    {
        return $this->hasOne(MemberContribution::class, 'memberId', 'memberId')
                    ->where('transactionStatus', 'Confirmed')
                    ->where('transactionType', 'Paid-In')
                    ->latest('transactionDate');
    }

}
