<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'player_id',
        'favorite_position',
        'dominant_foot',
        'playing_style',
        'skill_level',
        'playing_frequency',
    ];

    /**
     * Get the player that owns the profile.
     */
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
