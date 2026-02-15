<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberLoanType extends Model
{
    use HasFactory;

    protected $table = 'member_loan_types';
    protected $primaryKey = 'loanId';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'loan_type_name',
        'interest_rate',
        'max_amount',
        'repayment_period_months',
        'author',
        'status',
        'created_on',
        'updated_on',
    ];

    protected $casts = [
        'interest_rate' => 'decimal:2',
        'max_amount' => 'decimal:2',
        'created_on' => 'datetime',
        'updated_on' => 'datetime'
    ];

    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}