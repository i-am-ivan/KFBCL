<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberRegFee extends Model
{
    protected $table = 'member_reg_fees';
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
        'transactionUpdatedOn',
        'transactionStatus'
    ];

    protected $casts = [
        'transactionDate' => 'datetime',
        'transactionUpdatedOn' => 'datetime',
        'transactionAmount' => 'decimal:2'
    ];
}
