<?php

namespace app\Actions;

use app\Models\Player;
use app\Repositories\PlayerRepository;

class CreatePlayerAction
{
    public function __construct(
        private PlayerRepository $playerRepository
    ) {}

    public function execute(array $data): Player
    {
        return $this->playerRepository->create($data);
    }
}
