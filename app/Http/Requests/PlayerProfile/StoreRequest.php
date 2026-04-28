<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'player_id' => 'required|integer',
            'favorite_position' => 'required|string|max:100',
            'dominant_foot' => 'required|string|in:left,right',
            'playing_style' => 'required|string|max:100',
            'skill_level' => 'required|string|in:beginner,intermediate,advanced',
            'playing_frequency' => 'required|integer|min:1|max:7',
        ];
    }

    public function messages()
    {
        return [
            'player_id.required' => 'The player ID is required and must be an integer.',
            'favorite_position.required' => 'The favorite position is required and must be a string with a maximum length of 100 characters.',
            'dominant_foot.required' => 'The dominant foot is required and must be either left or right.',
            'playing_style.required' => 'The playing style is required and must be a string with a maximum length of 100 characters.',
            'skill_level.required' => 'The skill level is required and must be one of beginner, intermediate, or advanced.',
            'playing_frequency.required' => 'The playing frequency is required and must be an integer between 1 and 7.',
        ];
    }
}
