<?php

namespace App\Http\Commands;

use App\Repositories\OblastRepository;
use App\Services\CacheKeysService;
use Illuminate\Support\Facades\Cache;

class SearchDataCommand extends BaseCommand
{
    private array $result = [];
    private bool $cacheHit = false;

    public function __construct(private OblastRepository $oblastRepository, private CacheKeysService $cacheKeysService)
    {
    }

    public function execute(array $params): void
    {
        $longitude = $params['lon'];
        $latitude = $params['lat'];
        $cacheKey = $this->cacheKeysService->getKeyForGeoSearch($longitude, $latitude);

        $cacheResult = Cache::get($cacheKey);
        if ($cacheResult) {
            $this->cacheHit = true;
            $this->result = $cacheResult;
            return;
        }

        $this->result = $this->oblastRepository->search($longitude, $latitude);
        Cache::put($cacheKey, $this->result, now()->addHours(4));
    }

    public function getResult(): array
    {
        if (empty($this->result)) {
            return [
                'geo' => 'No data found',
                'cache' => 'miss'
            ];
        }

        return [
            'geo' => ['oblast' => $this->result[0]->name],
            'cache' => $this->cacheHit ? 'hit' : 'miss'
        ];
    }
}
