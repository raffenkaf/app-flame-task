<?php

namespace App\Http\Commands;

use App\Http\Resources\JobLogResource;
use App\Models\StatusEnums\JobLogJobType;
use App\Repositories\JobLogRepository;
use Illuminate\Http\Request;

class SearchJobCommand extends BaseCommand
{
    private array $result;

    public function __construct(private JobLogRepository $jobLogRepository, private Request $request)
    {
    }

    public function execute(array $params): void
    {
        $limit = $params['limit'] ?? 10;
        $type = $validated['type'] ?? JobLogJobType::REFRESH_GEO_POLYGONS;

        $jobLogs = $this->jobLogRepository->getByType($type, $limit);
        $this->result = JobLogResource::collection($jobLogs)->toArray($this->request);
    }

    public function getResult(): array
    {
        return $this->result;
    }
}
