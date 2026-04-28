<?php

namespace App\Http\Requests\Player;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|unique:players|max:255',
            'city' => 'required|string|max:255',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'required|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'The full name is required',
            'full_name.unique'   => 'The full name must be unique',
            'full_name.max'      => 'The full name must be at most 255 characters',
            'city.required'      => 'The city is required',
            'city.max'           => 'The city must be at most 255 characters',
            'avatar.required'    => 'The avatar is required',
            'avatar.image'       => 'The avatar must be an image',
            'bio.required'       => 'The bio is required',
            'bio.max'            => 'The bio must be at most 1000 characters',
        ];
    }
}
