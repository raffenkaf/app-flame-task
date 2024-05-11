<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Factories\DataActionCommandFactory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataController extends Controller
{
    public function updateAction(DataActionCommandFactory $factory, Request $request)
    {
        $validated = $request->validate([
            'action' => ['required', Rule::in(['refresh'])],
            'delaySeconds' => ['sometimes', 'integer', 'min:1', 'max:900'],
        ]);

        $command = $factory->create($validated['action']);
        $command->execute($validated);
        $result = $command->getResult();
        return response()->json(['data' => $result]);
    }

    public function getAction(DataActionCommandFactory $factory, Request $request)
    {
        $validated = $request->validate([
            'action' => ['required', Rule::in(['search'])],
        ]);

        $command = $factory->create($validated['action']);
        $command->execute($validated);
        $result = $command->getResult();

        return response()->json(['data' => $result]);
    }
}
