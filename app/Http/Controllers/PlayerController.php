<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function showProfile($id)
    {
        $user = User::with('matchPlayers')->findOrFail($id);

        $totalMatches = $user->matchPlayers()->count();
        $totalGoals = $user->matchPlayers()->sum('score');
        $wins = $user->matchPlayers()->where('is_winner', true)->count();
        $penaltyWins = $user->matchPlayers()
            ->whereHas('match', fn($q) => $q->where('won_by_penalty', true))
            ->where('is_winner', true)
            ->count();

        $highestScore = $user->matchPlayers()->max('score') ?? 0;
        $averageScore = $user->matchPlayers()->avg('score') ?? 0;
        $winRate = $totalMatches > 0 ? ($wins / $totalMatches) * 100 : 0;

        // Tambahan: data rata-rata semua pemain
        $allUsers = User::where('role', 'Player')->where('is_active', true)->get();
        $allStats = [
            'wins' => round($allUsers->avg(fn($u) => $u->matchPlayers->where('is_winner', true)->count())),
            'penaltyWins' => round($allUsers->avg(fn($u) => $u->matchPlayers->where('is_winner', true)->where(fn($q) => $q->match?->won_by_penalty)->count())),
            'goals' => round($allUsers->avg(fn($u) => $u->matchPlayers->sum('score'))),
            'highestScore' => round($allUsers->avg(fn($u) => $u->matchPlayers->max('score') ?? 0)),
            'averageScore' => round($allUsers->avg(fn($u) => $u->matchPlayers->avg('score') ?? 0), 2),
            'winRate' => round($allUsers->avg(function ($u) {
                $matchCount = $u->matchPlayers->count();
                return $matchCount ? ($u->matchPlayers->where('is_winner', true)->count() / $matchCount) * 100 : 0;
            }), 2)
        ];

        return view('players.profile', compact(
            'user',
            'totalMatches',
            'totalGoals',
            'wins',
            'penaltyWins',
            'highestScore',
            'averageScore',
            'winRate',
            'allStats'
        ));
    }
}
