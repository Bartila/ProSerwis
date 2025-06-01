<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    // Pola, które można masowo przypisywać (mass assignment)
    protected $fillable = [
    'name',
    'type',
    'user_id',
    'components',
    'weight',
    'description',
    'status',
    'deadline',
    ];

    // Relacja: jeden rower należy do jednego użytkownika
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
