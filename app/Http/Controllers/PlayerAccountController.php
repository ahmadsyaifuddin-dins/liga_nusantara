<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlayerAccountController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function index()
    {
        $players = User::where('role', 'Player')->get();
        return view('users.index', compact('players'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'Player',
            'is_active' => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Player berhasil ditambahkan');
    }

    public function toggleActive(User $user)
    {
    $user->is_active = !$user->is_active;
    $user->save();

    return redirect()->route('users.index')->with('success', 'Status user diperbarui.');
    }

}
