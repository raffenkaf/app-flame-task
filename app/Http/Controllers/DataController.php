<?php

namespace App\Http\Controllers;

use App\Http\Factories\DataActionCommandFactory;
use App\Http\Requests\DataGetActionRequest;
use App\Http\Requests\DataUpdateActionRequest;

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

    public function deleteAction(DataActionCommandFactory $factory)
    {
        $command = $factory->create('delete');
        $command->execute([]);
        $result = $command->getResult();
        return response()->json(['data' => $result]);
    }
}
