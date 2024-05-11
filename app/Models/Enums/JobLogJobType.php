<?php

namespace App\Models\Enums;

use App\Jobs\RefreshGeoPolygons;

enum JobLogJobType: string
{
    case REFRESH_GEO_POLYGONS = RefreshGeoPolygons::class;
}
