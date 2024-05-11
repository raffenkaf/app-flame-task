<?php

namespace App\Http\Commands;
interface Command
{
    public function execute(array $params): void;
    public function getResult(): array;
}
