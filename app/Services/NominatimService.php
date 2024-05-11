<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NominatimService
{
    public function getArea(array $searchParams): string
    {
        $result = Http::get('https://nominatim.openstreetmap.org/search', $searchParams);

        if ($result->failed() || !isset($result->json()[0]['geotext'])) {
            throw new \Exception('Failed to get area');
        }

        return $result[0]['geotext'];
    }
}
