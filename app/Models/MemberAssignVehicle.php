<?php

namespace App\Models;

use App\Models\MemberVehicle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberAssignVehicle extends Model
{
    //
    use HasFactory;

    protected $table = 'member_assign_vehicles';
    protected $primaryKey = 'assignedId';
    
    protected $fillable = [
        'rider',
        'vehicle',
        'assignedDate',
        'status',
        'author',
        'updated_on'
    ];
    
    public $timestamps = true;
    
    protected $casts = [
        'assignedDate' => 'datetime',
        'updated_on' => 'datetime'
    ];
    
    // Relationships
    public function member()
    {
        return $this->belongsTo(Member::class, 'rider', 'memberId');
    }
    
    public function vehicleDetail()
    {
        return $this->belongsTo(MemberVehicle::class, 'vehicle', 'vehicleId');
    }
    
    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

}
