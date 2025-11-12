<?php

namespace App\Http\Controllers;


use App\Models\Player; // Importar o modelo Player
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Importar o facade Storage
use Illuminate\Validation\ValidationException; // Importar ValidationException

class RegisterPlayerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|unique:players|max:255',
            'city' => 'required',
            'avatar' => 'required|image|max:2048',
            'bio' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();

        $avatarPath = $request->file('avatar')->store('avatars', 'public');

        $player = Player::create([
            'fullName' => $validated['fullName'],
            'city' => $validated['city'],
            'avatar' => $avatarPath,
            'bio' => $validated['bio'],
            'user_id' => $userId,
        ]);

        return response()->json([
            'message' => 'Player profile created successfully!',
            'player' => $player,
        ], 201);
    }
}
