<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $table = 'real_estate_clients';
    protected $primaryKey = 'real_estate_client_id';

    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'updated_on';

    protected $fillable = [
        'real_estate_fname',
        'real_estate_lname',
        'real_estate_email',
        'real_estate_phone',
        'real_estate_id_number',
        'real_estate_KRA',
        'real_estate_status',
        'created_by',
    ];

    protected $casts = [
        'created_on' => 'datetime',
        'updated_on' => 'datetime',
    ];

    /**
     * A client can own multiple properties.
     */
    public function properties(): HasMany
    {
        return $this->hasMany(ClientProperty::class, 'real_estate_client', 'real_estate_client_id');
    }

    /**
     * Accessor for full name (used in JSON responses).
     */
    public function getFullNameAttribute(): string
    {
        return $this->real_estate_fname . ' ' . $this->real_estate_lname;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
