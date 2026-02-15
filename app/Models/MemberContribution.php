<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
