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
        'latenes_interest_rate',
        'min_amount',
        'max_amount',
        'repayment_period_months',
        'grace_period_days',
        'min_duration',
        'max_duration',
        'status',
        'author',
        'created_on',
        'updated_on',
    ];

    protected $casts = [
        'interest_rate' => 'decimal:2',
        'latenes_interest_rate' => 'decimal:2',
        'max_amount' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'created_on' => 'datetime',
        'updated_on' => 'datetime'
    ];

    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
