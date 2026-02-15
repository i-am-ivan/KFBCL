<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberBonuses extends Model
{
    protected $table = 'member_bonuses';
    protected $primaryKey = 'transactionId';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'memberId',
        'transactionBonus',
        'transactionCode',
        'transactionAmount',
        'transactionDate',
        'transactionMode',
        'transactionAuthor',
        'transactionUpdatedOn',
        'transactionStatus'
    ];

    protected $casts = [
        'transactionDate' => 'datetime',
        'transactionUpdatedOn' => 'datetime',
        'transactionAmount' => 'decimal:2'
    ];
}
