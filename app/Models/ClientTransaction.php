<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientTransaction extends Model
{
    use HasFactory;

    protected $table = 'real_estate_client_transactions';
    protected $primaryKey = 'real_estate_transaction_id';

    // No created_on column, only updated_on
    const CREATED_AT = null;
    const UPDATED_AT = 'updated_on';

    protected $fillable = [
        'real_estate_property',
        'transaction_amount',
        'transaction_date',
        'transaction_status',
        'transaction_type',
        'transaction_mode',
        'transaction_code',
        'created_by',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'transaction_amount' => 'decimal:2',
        'updated_on' => 'datetime',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(ClientProperty::class, 'real_estate_property', 'real_estate_property_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
