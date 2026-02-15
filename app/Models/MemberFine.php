<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberFine extends Model
{
    protected $table = 'member_fines';
    protected $primaryKey = 'transactionId';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'memberId',
        'transactionFine',
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
