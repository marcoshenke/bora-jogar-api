<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerAvailability extends Model
{
    protected $fillable = [
        'player_profile_id',
        'day_of_week',
        'period_of_day',
    ];

    public function profile()
    {
        return $this->belongsTo(PlayerProfile::class, 'player_profile_id');
    }
}
