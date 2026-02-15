<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'type',
        'appointment_date',
        'company_name',
        'priority',
        'status',
        'created_by'
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            if (empty($appointment->appointment_id)) {
                $year = date('Y');
                $lastAppointment = self::whereYear('created_at', $year)->latest()->first();

                if ($lastAppointment) {
                    // Extract number from appointment_id like APT-2024-010
                    $lastNumber = (int) substr($lastAppointment->appointment_id, -3);
                    $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
                } else {
                    $nextNumber = '101';
                }

                $appointment->appointment_id = "APT-{$year}-{$nextNumber}";
            }
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
