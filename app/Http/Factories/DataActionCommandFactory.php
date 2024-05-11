<?php

namespace App\Http\Factories;

use App\Http\Commands\Command;
use App\Http\Commands\RefreshDataCommand;

class DataActionCommandFactory
{
    public function create(string $action): Command
    {
        if ($action === 'refresh') {
            return app(RefreshDataCommand::class);
        }

        throw new \InvalidArgumentException('Invalid action');
    }
}
