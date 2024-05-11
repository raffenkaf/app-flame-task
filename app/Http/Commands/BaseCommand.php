<?php

namespace App\Http\Commands;

abstract class BaseCommand implements Command
{
    const RESULT_SUCCESS = ['success' => true];
}
