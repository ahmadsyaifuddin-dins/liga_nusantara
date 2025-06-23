<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesMatchPlayer extends Model
{
    protected $fillable = ['pes_match_id', 'user_id', 'score', 'is_winner'];

    public function match()
    {
        return $this->belongsTo(PesMatch::class, 'pes_match_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
