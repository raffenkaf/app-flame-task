<?php

namespace App\Services;

class CacheKeysService
{

    public function getKeyForGeoSearch(float $longitude, float $latitude)
    {
        // 1 degree of lon and lat is approx 111 km, 0.01 degree is 1.11 km
        $longitude = round($longitude, 2);
        $latitude = round($latitude, 2);

        return "search_{$longitude}_{$latitude}";
    }
}
