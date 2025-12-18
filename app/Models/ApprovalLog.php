<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovalLog extends Model
{
    protected $fillable = [
        'admin_id',
        'action',
        'target_type',
        'target_id',
        'reason',
        'feedback',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getTargetAttribute()
    {
        if ($this->target_type === 'user') {
            return User::find($this->target_id);
        } elseif ($this->target_type === 'campaign') {
            return Campaign::find($this->target_id);
        }
        return null;
    }
}
