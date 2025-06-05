<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Model reprezentujący pojedynczy wpis logu aktywności w systemie.
 */

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id', 'action', 'model_type', 'model_id', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
