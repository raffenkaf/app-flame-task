<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobLog
 * @package App\Models
 *
 * @property int $id
 * @property string $type
 * @property Carbon $scheduled_at
 * @property Carbon $created_at
 * @property array $params
 */
class JobLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type',
        'scheduled_at',
        'params',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'created_at' => 'datetime'
    ];
}
