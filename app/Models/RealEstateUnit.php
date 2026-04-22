<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RealEstateUnit extends Model
{
    use HasFactory;

    protected $table = 'real_estate_units';
    protected $primaryKey = 'real_estate_unit_id';

    // Custom timestamp column names
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'updated_on';

    protected $fillable = [
        'real_estate_unit_name',
        'real_estate_location',
        'real_estate_license_number',
        'real_estate_valuation',
        'real_estate_ownership',
        'real_estate_status',
        'created_by',
    ];

    protected $casts = [
        'real_estate_valuation' => 'decimal:2',
        'created_on' => 'datetime',
        'updated_on' => 'datetime',
    ];

    /**
     * A unit can be linked to multiple client properties.
     */
    public function clientProperties(): HasMany
    {
        return $this->hasMany(ClientProperty::class, 'real_estate_unit', 'real_estate_unit_id');
    }

    /**
     * Relationship to the user who created the record.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
