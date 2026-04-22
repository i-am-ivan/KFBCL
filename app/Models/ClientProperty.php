<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientProperty extends Model
{
    use HasFactory;

    protected $table = 'real_estate_client_properties';
    protected $primaryKey = 'real_estate_property_id';

    // This table only has updated_on (no created_on)
    const CREATED_AT = null;
    const UPDATED_AT = 'updated_on';

    protected $fillable = [
        'real_estate_client',
        'real_estate_unit',
        'real_estate_purchase_date',
        'real_estate_purchase_amount',
        'real_estate_purchase_status',
        'created_by',
    ];

    protected $casts = [
        'real_estate_purchase_date' => 'datetime',
        'real_estate_purchase_amount' => 'decimal:2',
        'updated_on' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'real_estate_client', 'real_estate_client_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(RealEstateUnit::class, 'real_estate_unit', 'real_estate_unit_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(ClientTransaction::class, 'real_estate_property', 'real_estate_property_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
