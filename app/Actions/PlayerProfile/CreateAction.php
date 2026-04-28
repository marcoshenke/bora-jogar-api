<?php

namespace App\Actions;

use App\Models\Player;
use App\Repositories\PlayerRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreatePlayerAction
{
    public function __construct(
        private PlayerRepository $playerRepository
    ) {
        $this->playerRepository = $playerRepository;
    }

    public function execute(array $data): Player
    {

        try {
        } catch (\Exception $e) {
            Log::error('Error during upload: ' . $e->getMessage());
        }

        return $player;
    }
}
