<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorVisit extends Model
{
    protected $fillable = [
        'visitor_key',
        'ip',
        'city',
        'device',
        'user_agent',
        'page_url',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}
