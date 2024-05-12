<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class OblastRepository
{
    public function insert(string $name, string $area): void
    {
        if (str_contains($area, 'MULTIPOLYGON') ) {
            DB::insert(
                "insert into oblasts (name, area_as_multipolygon) values (?, ST_GeomFromText(?))",
                [$name, $area]
            );

            return;
        }

        DB::insert(
            "insert into oblasts (name, area_as_polygon) values (?, ST_GeomFromText(?))",
            [$name, $area]
        );
    }

    public function search(float $longitude, float $latitude): array
    {
        $result = DB::select(
            "select name
                     from oblasts
                   where
                     ST_Contains(area_as_polygon, POINT(?, ?))
                     OR ST_Contains(area_as_multipolygon, POINT(?, ?))",
            [$longitude, $latitude, $longitude, $latitude]
        );

        return $result;
    }
}
