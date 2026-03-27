<?php

namespace app\Repositories;

use app\Models\Player;

class PlayerRepository
{
    private $model;

    public function __construct(
        Player $model
    ) {
        $this->model = $model;
    }

    public function create(array $data): Player
    {
        return $this->model->create($data);
    }
}
