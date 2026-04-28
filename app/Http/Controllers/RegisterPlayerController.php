<?php

namespace App\Http\Controllers;

use App\Actions\Player\CreateAction;
use App\Http\Requests\Player\StoreRequest;

class RegisterPlayerController extends Controller
{
    public function __construct(
        private CreateAction $createAction
    ) {
        $this->createAction = $createAction;
    }

    public function store(StoreRequest $request)
    {
        $player = $this->createAction->execute($request->validated());

        return response()->json([
            'message' => 'Player profile created successfully!',
            'player' => $player,
        ], 201);
    }
}
