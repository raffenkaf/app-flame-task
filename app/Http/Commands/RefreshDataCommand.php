<?php

namespace App\Http\Commands;

use App\Jobs\RefreshGeoPolygons;
use App\Models\JobLog;
use App\Models\Enums\JobLogJobType;
use App\Repositories\JobLogRepository;

class RefreshDataCommand extends BaseCommand
{

    public function __construct(private array $result = self::RESULT_SUCCESS)
    {
    }

    public function execute(array $params): void
    {
        $delayInSeconds = $params['delaySeconds'] ?? 0;

        $jobLog = new JobLog([
            'type' => JobLogJobType::REFRESH_GEO_POLYGONS,
            'scheduled_at' => now()->addSeconds($delayInSeconds),
        ]);
        $jobLog->save();

        RefreshGeoPolygons::dispatch($jobLog->id)->delay(now()->addSeconds($delayInSeconds));
    }

    public function getResult(): array
    {
        return $this->result;
    }
}
