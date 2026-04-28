<?php

namespace App\Repositories;

use App\Models\PlayerProfile;

class PlayerProfileRepository
{
    private $model;

    public function __construct(
        PlayerProfile $model
    ) {
        $this->model = $model;
    }

    public function create(array $data): PlayerProfile
    {
        return $this->model->create($data);
    }
}
