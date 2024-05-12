<?php

namespace App\Http\Factories;

use App\Http\Commands\Command;
use App\Http\Commands\DeleteDataCommand;
use App\Http\Commands\RefreshDataCommand;
use App\Http\Commands\SearchDataCommand;

class DataActionCommandFactory implements CommandFactory
{
    public function create(string $action): Command
    {
        switch ($action) {
            case 'search':
                return app(SearchDataCommand::class);
            case 'refresh':
                return app(RefreshDataCommand::class);
        }

        throw new \InvalidArgumentException('Invalid action');
    }
}
