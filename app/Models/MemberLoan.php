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
        'transactionTotalLoan',
        'transactionLoanPeriod',
        'transactionLoanStartDate',
        'transactionLoanRepaymentMode',
        'transactionAuthor',
        'transactionCreated',
        'transactionUpdatedOn',
        'transactionStatus',
        'transactionLoanEndDate'
    ];

    protected $casts = [
        'transactionLoanStartDate' => 'datetime',
        'transactionLoanEndDate' => 'datetime',
        'transactionCreated' => 'datetime',
        'transactionUpdatedOn' => 'datetime',
        'transactionLoanAmount' => 'decimal:2',
        'transactionTotalLoan' => 'decimal:2'
    ];
}
