<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BikeStat extends Model
{
    protected $table = 'bike_stats';
    protected $fillable = ['total_added'];
}
