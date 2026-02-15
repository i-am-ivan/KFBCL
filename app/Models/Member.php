<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'memberId';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; // using created_on / updated_on

    // Updated fillable (removed ID-related columns that moved to members_identification)
    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone1', 'phone2',
        'gender', 'dob', 'author', 'membership', 'status'
    ];

    // Add this new relationship for identification
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
}
