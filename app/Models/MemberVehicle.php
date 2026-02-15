<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberVehicle extends Model
{
    protected $table = 'members_vehicles';
    protected $primaryKey = 'vehicleId';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['member','plate_number','make','model','brand','yom','CC','NTSA_compliant','insurance','status'];

    public function owner()
    {
        return $this->belongsTo(Member::class, 'member', 'memberId');
    }
}