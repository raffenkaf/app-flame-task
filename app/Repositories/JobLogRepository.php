<?php

namespace App\Repositories;

use App\Models\JobLog;

class JobLogRepository
{

    public function getByType(mixed $type, mixed $limit)
    {
        return JobLog::where('type', $type)
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();
    }
}
