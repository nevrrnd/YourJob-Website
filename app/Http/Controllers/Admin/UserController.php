<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->role, fn ($q) => $q->where('role', $request->role))
            ->when($request->q, fn ($q) => $q->where(function ($w) use ($request) {
                $w->where('name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%");
            }))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function toggle(User $user)
    {
        abort_if($user->isAdmin(), 403, 'Tidak dapat menonaktifkan admin.');

        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', $user->is_active ? 'Pengguna diaktifkan.' : 'Pengguna dinonaktifkan.');
    }

    public function destroy(User $user)
    {
        abort_if($user->isAdmin(), 403, 'Tidak dapat menghapus admin.');

        $user->delete();

        return back()->with('success', 'Pengguna dihapus.');
    }
}
