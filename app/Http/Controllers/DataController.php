<?php

namespace App\Http\Controllers;

use App\Http\Factories\DataActionCommandFactory;
use App\Http\Requests\DataGetActionRequest;
use App\Http\Requests\DataUpdateActionRequest;
use App\Models\Oblast;

class DataController extends Controller
{
    public function updateAction(DataActionCommandFactory $factory, DataUpdateActionRequest $request)
    {
        $validated = $request->validated();

        $command = $factory->create($validated['action']);
        $command->execute($validated);
        $result = $command->getResult();
        return response()->json(['data' => $result]);
    }

    public function getAction(DataActionCommandFactory $factory, DataGetActionRequest $request)
    {
        $validated = $request->validated();

        $command = $factory->create($validated['action']);
        $command->execute($validated);
        $result = $command->getResult();
        return response()->json(['data' => $result]);
    }

    public function deleteAction()
    {
        Oblast::truncate();

        return response()->json(['data' => ['result' => 'success']]);
    }
}
