<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    protected $fillable = [
        'type',
        'user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
