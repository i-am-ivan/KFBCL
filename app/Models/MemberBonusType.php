<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberBonusType extends Model
{
    use HasFactory;

    protected $table = 'member_bonus_types';
    protected $primaryKey = 'bonusId';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'bonus_name',
        'description',
        'calculation_method',
        'percentage',
        'author',
        'status',
        'created_on',
        'updated_on',
    ];

    protected $casts = [
        'percentage' => 'decimal:2',
        'created_on' => 'datetime',
        'updated_on' => 'datetime'
    ];

    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}