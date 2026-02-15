<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserRole extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'user_roles';

    /**
     * The primary key for the model.
     */
    protected $primaryKey = 'user_role_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    /**
     * The "type" of the primary key ID.
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model should be timestamped.
     * We're using custom timestamps, so set to false.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_role',
        'user_role_status',
        'user_role_creator',
        'user_role_created_on',
        'user_role_updated_on',
        
        // Bodaboda privileges
        'user_role_bodaboda_create',
        'user_role_bodaboda_read',
        'user_role_bodaboda_update',
        'user_role_bodaboda_delete',
        
        // Loans privileges
        'user_role_loans_create',
        'user_role_loans_read',
        'user_role_loans_update',
        'user_role_loans_delete',
        
        // Lands privileges
        'user_role_lands_create',
        'user_role_lands_read',
        'user_role_lands_update',
        'user_role_lands_delete',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'user_role_created_on' => 'datetime',
        'user_role_updated_on' => 'datetime',
        
        // Cast boolean fields
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

    /**
     * The attributes that should be appended to the model's array form.
     */
    protected $appends = [
        'display_role_id',
        'formatted_created_on',
        'formatted_updated_on',
        'creator_name',
        'privileges_summary',
    ];

    /**
     * Boot method to set default values
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Set creator to current user if not set
            if (Auth::check() && !$model->user_role_creator) {
                $model->user_role_creator = Auth::user()->id;
            }
            
            // Set created timestamp
            $model->user_role_created_on = now();
        });

        static::updating(function ($model) {
            // Set updated timestamp
            $model->user_role_updated_on = now();
        });
    }

    /**
     * Relationship with the user who created this role
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_role_creator', 'id');
    }

    /**
     * Accessor for display role ID (RL-1001 format)
     */
    public function getDisplayRoleIdAttribute()
    {
        return 'RL-' . $this->user_role_id;
    }

    /**
     * Accessor for formatted created date
     */
    public function getFormattedCreatedOnAttribute()
    {
        return $this->user_role_created_on 
            ? $this->user_role_created_on->format('M d, Y h:i A') 
            : null;
    }

    /**
     * Accessor for formatted updated date
     */
    public function getFormattedUpdatedOnAttribute()
    {
        return $this->user_role_updated_on 
            ? $this->user_role_updated_on->format('M d, Y h:i A') 
            : null;
    }

    /**
     * Accessor for creator name
     */
    public function getCreatorNameAttribute()
    {
        return $this->creator ? $this->creator->name : 'System';
    }

    /**
     * Accessor for privileges summary
     */
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

    /**
     * Check if role has specific privilege
     */
    public function hasPrivilege($module, $action)
    {
        $fieldName = 'user_role_' . strtolower($module) . '_' . $action;
        
        return property_exists($this, $fieldName) && $this->$fieldName == true;
    }

    /**
     * Get all active privileges as array
     */
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

    /**
     * Scope for active roles
     */
    public function scopeActive($query)
    {
        return $query->where('user_role_status', 'Active');
    }

    /**
     * Scope for pending roles
     */
    public function scopePending($query)
    {
        return $query->where('user_role_status', 'Pending');
    }

    /**
     * Scope for suspended roles
     */
    public function scopeSuspended($query)
    {
        return $query->where('user_role_status', 'Suspended');
    }

    /**
     * Scope to search roles
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('user_role', 'like', '%' . $search . '%')
            ->orWhere('user_role_id', 'like', '%' . $search . '%');
    }

    /**
     * Check if role can be deleted (no users assigned)
     * You can implement this later when you have user-role relationships
     */
    public function canBeDeleted()
    {
        // Add logic to check if any users are assigned this role
        return true; // For now, return true
    }
}