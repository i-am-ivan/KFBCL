<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $table = 'stages';
    protected $primaryKey = 'stageId';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['location','established','manager','author','status'];

    public function manager()
    {
        return $this->belongsTo(Member::class, 'manager', 'memberId');
    }

    public function authorUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'author', 'id');
    }
}