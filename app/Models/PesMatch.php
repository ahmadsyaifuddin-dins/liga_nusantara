<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesMatch extends Model
{
    protected $fillable = ['judul', 'winner_id', 'documentation', 'won_by_penalty']; // <-- tambahkan winner_id di sini

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function players()
    {
        return $this->hasMany(PesMatchPlayer::class);
    }
}


