<?php

namespace App\Models\Enums;

enum JobLogStatus: int
{
    case CREATED = 0;
    case IN_PROGRESS = 1;
    case COMPLETED = 2;
}
