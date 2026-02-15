<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberIdentification extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'identification_code';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_identifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'member_id',
        'national_id',
        'driver_license',
        'driving_license_type',
        'ntsa_compliance',
        'national_id_front_path',
        'national_id_back_path',
        'author',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the member that owns the identification.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'memberId');
    }

    /**
     * Get the author (user) who created the identification.
     */
    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author');
    }
}
