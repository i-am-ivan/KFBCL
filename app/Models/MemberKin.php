<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberKin extends Model
{
    protected $table = 'member_kin';
    protected $primaryKey = 'kin_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    // Updated fillable (added status)
    protected $fillable = [
        'member', 'firstname', 'lastname', 'email',
        'phone', 'relation', 'status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member', 'memberId');
    }
}
