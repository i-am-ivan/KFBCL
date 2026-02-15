<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberLoanTransaction extends Model
{
    protected $table = 'member_loans_transactions';
    protected $primaryKey = 'transactionId';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'memberId',
        'transactionLoan',
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
