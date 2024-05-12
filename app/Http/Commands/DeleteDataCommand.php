<?php

namespace App\Http\Commands;

use App\Models\Oblast;

class DeleteDataCommand extends BaseCommand
{
    public function execute(array $params): void
    {
        Oblast::truncate();
    }

    public function getResult(): array
    {
        return ['status' => 'success'];
    }
}
