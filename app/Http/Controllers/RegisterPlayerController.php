<?php

namespace App\Http\Controllers;


use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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

    // transform in action after
    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        try {
            $file = $request->file('file');
            $fileName = 'profile-pictures/' . Str::uuid() . '.' . $file->getClientOriginalExtension();

            Storage::disk('s3')->put($fileName, file_get_contents($file), 'public');

            $url = Storage::disk('s3')->url($fileName);

            return response()->json([
                'url' => $url,
                'path' => $fileName
            ]);
        } catch (\Exception $e) {
            Log::error('Error during upload: ' . $e->getMessage());
            return response()->json([
                'error' => 'Unable to upload the file.'
            ], 500);
        }
    }
}
