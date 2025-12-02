<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = ['user_id', 'activity_name', 'target_amount', 'proposal_file'];
}
