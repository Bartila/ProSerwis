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
    'info',
    'description',
    'status',
    'deadline',
    'qr_code',
    ];

    // jeden rower należy do jednego użytkownika
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
