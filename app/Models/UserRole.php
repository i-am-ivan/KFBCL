<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';
    protected $primaryKey = 'user_role_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'user_role',
        'user_role_status',
        'user_role_creator',
        'user_role_created_on',
        'user_role_updated_on',

        'user_role_bodaboda_create',
        'user_role_bodaboda_read',
        'user_role_bodaboda_update',
        'user_role_bodaboda_delete',

        'user_role_loans_create',
        'user_role_loans_read',
        'user_role_loans_update',
        'user_role_loans_delete',

        'user_role_lands_create',
        'user_role_lands_read',
        'user_role_lands_update',
        'user_role_lands_delete',
    ];

    protected $casts = [
        'user_role_created_on' => 'datetime',
        'user_role_updated_on' => 'datetime',

        'user_role_bodaboda_create' => 'boolean',
        'user_role_bodaboda_read' => 'boolean',
        'user_role_bodaboda_update' => 'boolean',
        'user_role_bodaboda_delete' => 'boolean',
        'user_role_loans_create' => 'boolean',
        'user_role_loans_read' => 'boolean',
        'user_role_loans_update' => 'boolean',
        'user_role_loans_delete' => 'boolean',
        'user_role_lands_create' => 'boolean',
        'user_role_lands_read' => 'boolean',
        'user_role_lands_update' => 'boolean',
        'user_role_lands_delete' => 'boolean',
    ];

    protected $appends = [
        'display_role_id',
        'formatted_created_on',
        'formatted_updated_on',
        'creator_name',
        'privileges_summary',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check() && !$model->user_role_creator) {
                $model->user_role_creator = Auth::user()->id;
            }
            $model->user_role_created_on = now();
        });

        static::updating(function ($model) {
            $model->user_role_updated_on = now();
        });
    }

    /**
     * Relationship: Creator user
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_role_creator', 'id');
    }

    /**
     * Relationship: Users that have this role
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role', 'user_role_id');
    }

    // Accessors (keep as is)
    public function getDisplayRoleIdAttribute()
    {
        return 'RL-' . $this->user_role_id;
    }

    public function getFormattedCreatedOnAttribute()
    {
        return $this->user_role_created_on
            ? $this->user_role_created_on->format('M d, Y h:i A')
            : null;
    }

    public function getFormattedUpdatedOnAttribute()
    {
        return $this->user_role_updated_on
            ? $this->user_role_updated_on->format('M d, Y h:i A')
            : null;
    }

    public function getCreatorNameAttribute()
    {
        return $this->creator ? $this->creator->full_name : 'System';
    }

    public function getPrivilegesSummaryAttribute()
    {
        $modules = [
            'Bodaboda' => [
                'create' => $this->user_role_bodaboda_create,
                'read' => $this->user_role_bodaboda_read,
                'update' => $this->user_role_bodaboda_update,
                'delete' => $this->user_role_bodaboda_delete,
            ],
            'Loans' => [
                'create' => $this->user_role_loans_create,
                'read' => $this->user_role_loans_read,
                'update' => $this->user_role_loans_update,
                'delete' => $this->user_role_loans_delete,
            ],
            'Real Estate' => [
                'create' => $this->user_role_lands_create,
                'read' => $this->user_role_lands_read,
                'update' => $this->user_role_lands_update,
                'delete' => $this->user_role_lands_delete,
            ],
        ];

        $summary = [];
        foreach ($modules as $module => $privileges) {
            $activePrivileges = array_keys(array_filter($privileges));
            if (!empty($activePrivileges)) {
                $summary[] = $module . ': ' . implode(', ', $activePrivileges);
            }
        }

        return !empty($summary) ? implode(' | ', $summary) : 'No privileges';
    }

    public function hasPrivilege($module, $action)
    {
        $fieldName = 'user_role_' . strtolower($module) . '_' . $action;
        return property_exists($this, $fieldName) && $this->$fieldName == true;
    }

    public function getActivePrivilegesAttribute()
    {
        $privileges = [];
        $fields = [
            'bodaboda' => ['create', 'read', 'update', 'delete'],
            'loans' => ['create', 'read', 'update', 'delete'],
            'lands' => ['create', 'read', 'update', 'delete'],
        ];

        foreach ($fields as $module => $actions) {
            foreach ($actions as $action) {
                $fieldName = 'user_role_' . $module . '_' . $action;
                if ($this->$fieldName) {
                    $privileges[] = [
                        'module' => ucfirst($module),
                        'action' => $action,
                        'label' => ucfirst($module) . ' - ' . ucfirst($action),
                    ];
                }
            }
        }
        return $privileges;
    }

    public function scopeActive($query)
    {
        return $query->where('user_role_status', 'Active');
    }

    public function scopePending($query)
    {
        return $query->where('user_role_status', 'Pending');
    }

    public function scopeSuspended($query)
    {
        return $query->where('user_role_status', 'Suspended');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('user_role', 'like', '%' . $search . '%')
            ->orWhere('user_role_id', 'like', '%' . $search . '%');
    }

    public function canBeDeleted()
    {
        // A role cannot be deleted if it has users assigned
        return $this->users()->count() === 0;
    }
}
