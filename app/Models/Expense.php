<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'amount', 'category', 'date', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
