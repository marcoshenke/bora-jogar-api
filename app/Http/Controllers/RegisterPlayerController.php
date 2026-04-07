<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterPlayerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|unique:players|max:255',
            'city' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();

        try {
            $player = Player::create([
                'full_name' => $validated['full_name'],
                'city' => $validated['city'],
                'bio' => $validated['bio'],
                'user_id' => $userId,
                'avatar' => '',
            ]);

            $avatarPath = $request->file('avatar')->storeAs('avatars/' . $userId . '/' . $player->id, $request->file('avatar')->getClientOriginalName(), 'public');

            $player->avatar = $avatarPath;
            $player->save();
        } catch (\Exception $e) {
            Log::error('Error during upload: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
                'backtrace' => $e->getTraceAsString(),
            ], 500);
        }

        return response()->json([
            'message' => 'Player profile created successfully!',
            'player' => $player,
        ], 201);
    }
}
