<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberLoan extends Model
{
    protected $table = 'member_loans';
    protected $primaryKey = 'transactionId';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'memberId',
        'transactionLoan',
        'transactionLoanAmount',
        'transactionLoanPeriod',
        'transactionLoanStartDate',
        'transactionLoanRepaymentMode',
        'transactionAuthor',
        'transactionCreated',
        'transactionUpdatedOn',
        'transactionStatus'
    ];

    protected $casts = [
        'transactionLoanStartDate' => 'datetime',
        'transactionCreated' => 'datetime',
        'transactionUpdatedOn' => 'datetime',
        'transactionLoanAmount' => 'decimal:2'
    ];
}
