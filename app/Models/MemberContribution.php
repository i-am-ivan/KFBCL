<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MemberContribution extends Model
{
    protected $table = 'member_contributions';
    protected $primaryKey = 'transactionId';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'memberId',
        'transactionCode',
        'transactionAmount',
        'transactionDate',
        'transactionMode',
        'transactionType',
        'transactionAuthor',
        'transactionUpdatedOn',
        'transactionStatus'
    ];

    protected $casts = [
        'transactionDate' => 'datetime',
        'transactionUpdatedOn' => 'datetime',
        'transactionAmount' => 'decimal:2'
    ];

    /**
     * Relationship: Contribution belongs to a Member.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'memberId', 'memberId');
    }

    /**
     * Relationship: Contribution was authored by a User.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'transactionAuthor', 'id');
    }

    /**
     * Boot method – clear member list cache when a contribution changes.
     */
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('members.all.with.contributions');
        });

        static::deleted(function () {
            Cache::forget('members.all.with.contributions');
        });
    }
}
