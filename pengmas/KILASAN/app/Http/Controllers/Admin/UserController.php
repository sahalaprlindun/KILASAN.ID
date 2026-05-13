<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->whereIn('role', ['admin', 'superadmin'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->string('q');
                $query->where(fn ($subQuery) => $subQuery
                    ->where('username', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%"));
            })
            ->orderBy('username')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'in:admin,superadmin'],
        ]);

        User::create($validated);

        return back()->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->is($user)) {
            return back()->withErrors(['user' => 'Akun yang sedang login tidak bisa dihapus.']);
        }

        $user->delete();

        return back()->with('success', 'Petugas berhasil dihapus.');
    }
}
