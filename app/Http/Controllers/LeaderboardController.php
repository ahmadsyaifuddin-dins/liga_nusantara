<?php

namespace App\Http\Controllers;

use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        $players = User::where('role', 'Player')
            ->where('is_active', true)
            ->withCount([
                'matchPlayers as wins' => function ($q) {
                    $q->where('is_winner', true)
                        ->whereHas('match', function ($query) {
                            $query->whereNotNull('winner_id'); // pastikan match punya pemenang
                        });
                }
            ])
            ->withCount('matchPlayers as matches')
            ->withAvg('matchPlayers as avg_score', 'score')
            ->orderByDesc('wins')
            ->orderByDesc('avg_score')
            ->get();

        return view('leaderboard.index', compact('players'));
    }
}
