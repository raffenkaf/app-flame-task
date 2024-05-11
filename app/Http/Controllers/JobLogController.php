<?php

namespace App\Http\Controllers;

use App\Http\Factories\JobActionCommandFactory;
use App\Http\Requests\JobLogGetActionRequest;

class JobLogController extends Controller
{
    public function getAction(JobActionCommandFactory $factory, JobLogGetActionRequest $request)
    {
        $validated = $request->validated();

        $command = $factory->create($validated['action']);
        $command->execute($validated);

        return response()->json(['data' => $command->getResult()]);
    }
}
