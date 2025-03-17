<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    protected $fillable = ['user_id', 'title', 'goal_amount', 'current_amount', 'target_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
