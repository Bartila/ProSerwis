<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $fillable = [
    'name',
    'type',
    'user_id',
    'phone',
    'components',
    'info',
    'weight',
    'description',
    'status',
    'deadline',
    ];

    // jeden rower należy do jednego użytkownika
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
