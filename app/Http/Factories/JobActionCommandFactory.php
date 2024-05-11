<?php

namespace App\Http\Factories;

use App\Http\Commands\Command;
use App\Http\Commands\SearchJobCommand;

class JobActionCommandFactory implements CommandFactory
{

    public function create(string $action): Command
    {
        if ($action === 'list') {
            return app(SearchJobCommand::class);
        }

        throw new \InvalidArgumentException('Invalid action');
    }
}
