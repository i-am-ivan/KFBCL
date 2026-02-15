<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberFineType extends Model
{
    use HasFactory;

    protected $table = 'member_fine_types';
    protected $primaryKey = 'fineId';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'fine_name',
        'description',
        'percentage',
        'is_percentage',
        'author',
        'status',
        'created_on',
        'updated_on',
    ];

    protected $casts = [
        'percentage' => 'decimal:2',
        'is_percentage' => 'boolean',
        'created_on' => 'datetime',
        'updated_on' => 'datetime'
    ];

    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
