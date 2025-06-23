<?php

namespace App\Http\Controllers;

use App\Models\PesMatch;
use App\Models\PesMatchPlayer;
use App\Models\User;
use Illuminate\Http\Request;

class PesMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matches = PesMatch::with(['players.user', 'winner'])->latest()->get();
        return view('matches.index', compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'Player')->where('is_active', true)->get();
        return view('matches.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'nullable|string|max:255',
            'players' => 'required|array|min:2|max:6',
            'players.*.user_id' => 'required|exists:users,id',
            'players.*.score' => 'required|integer|min:0',
            'documentation' => 'nullable|file|mimes:jpg,jpeg,png,pdf,webp|max:2048',
            'penalty_winner_id' => 'nullable|exists:users,id', // Tambahan
        ]);

        $penaltyWinnerId = $request->input('penalty_winner_id');

        $maxScore = collect($validated['players'])->max('score');
        $topPlayers = collect($validated['players'])->where('score', $maxScore);

        if ($topPlayers->count() === 1) {
            $winnerId = $topPlayers->first()['user_id'];
            $wonByPenalty = false;
        } elseif ($penaltyWinnerId && collect($validated['players'])->pluck('user_id')->contains($penaltyWinnerId)) {
            $winnerId = $penaltyWinnerId;
            $wonByPenalty = true;
        } else {
            $winnerId = null;
            $wonByPenalty = false;
        }

        $match = PesMatch::create([
            'judul' => $validated['judul'],
            'winner_id' => $winnerId,
            'won_by_penalty' => $wonByPenalty, // simpan
        ]);

        foreach ($validated['players'] as $playerData) {
            PesMatchPlayer::create([
                'pes_match_id' => $match->id,
                'user_id' => $playerData['user_id'],
                'score' => $playerData['score'],
                'is_winner' => $playerData['score'] == $maxScore || $playerData['user_id'] == $winnerId,
            ]);
        }

        if ($request->hasFile('documentation')) {
            $file = $request->file('documentation');
            $path = $file->store('matches', 'public');
            $match->update(['documentation' => $path]);
        }

        if ($winnerId) {
            User::where('id', $winnerId)->increment('trophies');
        }

        return redirect()->route('matches.index')->with('success', 'Match berhasil ditambahkan!');
    }




    /**
     * Display the specified resource.
     */
    public function show(PesMatch $pesMatch)
    {
        return view('matches.show', compact('pesMatch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesMatch $pesMatch)
    {
        return view('matches.edit', compact('pesMatch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PesMatch $pesMatch)
    {
        $data = $request->validate([
            'judul' => 'nullable|string|max:255',
            'players' => 'required|array|min:2|max:6',
            'players.*.user_id' => 'required|exists:users,id',
            'players.*.score' => 'required|integer|min:0',
        ]);

        $winner_id = null;
        if ($data['players'][0]['score'] > $data['players'][1]['score']) {
            $winner_id = $data['players'][0]['user_id'];
        } elseif ($data['players'][1]['score'] > $data['players'][0]['score']) {
            $winner_id = $data['players'][1]['user_id'];
        }

        $pesMatch->update([
            ...$data,
            'winner_id' => $winner_id,
        ]);

        if ($winner_id) {
            User::where('id', $winner_id)->increment('trophies');
        }

        return redirect()->route('matches.index')->with('success', 'Pertandingan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PesMatch $pesMatch)
    {
        $pesMatch->delete();

        return redirect()->route('matches.index')->with('success', 'Pertandingan berhasil dihapus');
    }
}
