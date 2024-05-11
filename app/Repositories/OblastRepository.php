<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class OblastRepository
{
    public function insert(string $name, string $area): void
    {
        if (str_contains($area, 'MULTIPOLYGON') ) {
            DB::insert(
                "insert into oblasts (name, area_as_multipolygon) values (?, ST_GEOMFROMTEXT(?))",
                [$name, $area]
            );

            return;
        }

        DB::insert(
            "insert into oblasts (name, area_as_polygon) values (?, ST_PolygonFromText(?))",
            [$name, $area]
        );
    }
}
