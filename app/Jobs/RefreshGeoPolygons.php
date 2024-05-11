<?php

namespace App\Jobs;

use App\Models\Enums\JobLogStatus;
use App\Models\JobLog;
use App\Models\Oblast;
use App\Repositories\OblastRepository;
use App\Services\NominatimService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;

class RefreshGeoPolygons implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $jobLogId)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(NominatimService $nominatimService, OblastRepository $oblastRepository): void
    {
        Oblast::truncate();

        $jobLog = JobLog::find($this->jobLogId);
        $jobLog->update(['status' => JobLogStatus::IN_PROGRESS]);

        foreach (config('geo_locations.searched_locations') as $geoLocationParams) {
            $geoLocationParams = $this->addDefaultGeoParams($geoLocationParams);

            $area = $nominatimService->getArea($geoLocationParams);
            $oblastRepository->insert($geoLocationParams['state'], $area);
        }

        $jobLog->update(['status' => JobLogStatus::COMPLETED]);
    }

    public function middleware(): array
    {
        return [new WithoutOverlapping(self::class)];
    }

    private function addDefaultGeoParams(array $geoLocationParams): array
    {
        $geoLocationParams['format'] = 'json';
        // add a geo-polygon with geo-points to the response
        // look for nominatim api documentation for more details
        $geoLocationParams['polygon_text'] = 1;

        return $geoLocationParams;
    }
}
