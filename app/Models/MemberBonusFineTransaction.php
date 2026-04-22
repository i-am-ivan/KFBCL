<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MemberBonusFineTransaction extends Model
{
    protected $table = 'member_bonus_fine_transactions';
    protected $primaryKey = 'transactionID';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;   // We manage our own timestamps

    protected $fillable = [
        'member_id',
        'bonus_type_id',
        'fine_type_id',
        'transactionAmount',
        'transactionDate',
        'transactionMode',
        'transactionCode',
        'transactionStatus',
        'transactionAuthor',
        'created_on',
        'transactionUpdated_On',
    ];

    protected $casts = [
        'transactionAmount'     => 'decimal:2',
        'transactionDate'       => 'datetime',
        'created_on'            => 'datetime',
        'transactionUpdated_On' => 'datetime',
    ];

    protected $appends = ['type_name', 'type_category'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Set author from logged-in user if not already provided
            if (Auth::check() && !$model->transactionAuthor) {
                $model->transactionAuthor = Auth::id();
            }
            // Ensure created_on is set (migration can also use default)
            if (!$model->created_on) {
                $model->created_on = now();
            }
        });

        static::updating(function ($model) {
            $model->transactionUpdated_On = now();
        });
    }

    // Relationships (unchanged)
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'memberId');
    }

    public function bonusType()
    {
        return $this->belongsTo(MemberBonusType::class, 'bonus_type_id', 'bonusId');
    }

    public function fineType()
    {
        return $this->belongsTo(MemberFineType::class, 'fine_type_id', 'fineId');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'transactionAuthor', 'id');
    }

    // Computed type name
    public function getTypeNameAttribute()
    {
        if ($this->bonus_type_id && $this->relationLoaded('bonusType')) {
            return $this->bonusType->bonus_name ?? 'Bonus';
        } elseif ($this->fine_type_id && $this->relationLoaded('fineType')) {
            return $this->fineType->fine_name ?? 'Fine';
        }
        return 'N/A';
    }
    
    public function getTypeCategoryAttribute()
    {
        return $this->bonus_type_id ? 'Bonus' : 'Fine';
    }
}
