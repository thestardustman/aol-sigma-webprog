<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'user_id', 
        'activity_name',
        'activity_date',
        'activity_address', 
        'target_amount', 
        'pic_name',
        'pic_birth_place',
        'pic_birth_date',
        'pic_address',
        'pic_city',
        'pic_province',
        'pic_country',
        'pic_zip',
        'pic_gender',
        'proposal_file',
        'status',
        'rejection_reason',
];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
