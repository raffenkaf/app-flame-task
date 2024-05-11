<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type',
        'scheduled_at',
        'params'
    ];
}
