<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTransaction extends Model
{
    use HasFactory;

    protected $table = 'member_transactions';
    protected $primaryKey = 'transactionCode';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'member',
        'transaction_type',
        'transaction_amount',
        'transactionMethod',
        'amount',
        'transaction_date',
        'description',
        'payment_method',
        'author',
        'status'
    ];

    protected $casts = [
        'transaction_amount' => 'decimal:2',
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
        'created_on' => 'datetime',
        'updated_on' => 'datetime'
    ];

    public function memberRecord()
    {
        return $this->belongsTo(Member::class, 'member', 'memberId');
    }

    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
