<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberSaving extends Model
{
    protected $table = 'member_savings';
    protected $primaryKey = 'transactionId';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'memberId',
        'transactionCode',
        'transactionAmount',
        'transactionDate',
        'transactionMode',
        'transactionAuthor',
        'transactionType',
        'transactionUpdatedOn',
        'transactionStatus'
    ];

    protected $casts = [
        'transactionDate' => 'datetime',
        'transactionUpdatedOn' => 'datetime',
        'transactionAmount' => 'decimal:2'
    ];
}
