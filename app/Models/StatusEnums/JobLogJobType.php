<?php

namespace App\Models\StatusEnums;

use App\Jobs\RefreshGeoPolygons;

enum JobLogJobType: string
{
    case REFRESH_GEO_POLYGONS = RefreshGeoPolygons::class;
}
