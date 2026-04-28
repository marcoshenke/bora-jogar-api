<?php

namespace App\Actions\Player;

use App\Models\Player;
use App\Repositories\PlayerRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreateAction
{
    public function __construct(
        private PlayerRepository $playerRepository
    ) {
        $this->playerRepository = $playerRepository;
    }

    public function execute(array $data): Player
    {
        $userId = Auth::id();

        try {
            $player = $this->playerRepository->create([
                'full_name' => $data['full_name'],
                'city' => $data['city'],
                'bio' => $data['bio'],
                'user_id' => $userId,
                'avatar' => '',
            ]);

            $avatarPath = $data['avatar']->storeAs('avatars/' . $userId . '/' . $player->id, $data['avatar']->getClientOriginalName(), 'public');

            $player->avatar = $avatarPath;
            $player->save();
        } catch (\Exception $e) {
            Log::error('Error during upload: ' . $e->getMessage());
        }

        return $player;
    }
}
