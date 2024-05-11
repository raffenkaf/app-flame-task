<?php

namespace App\Http\Factories;

use App\Http\Commands\Command;

interface CommandFactory
{
    public function create(string $action): Command;
}
