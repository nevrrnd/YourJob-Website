<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    public function index(Request $request)
    {
        $histories = LoginHistory::query()
            ->with('user')
            ->whereHas('user', fn ($query) => $query->where('role', 'admin'))
            ->when($request->q, fn ($query) => $query->where(function ($where) use ($request) {
                $where->where('ip_address', 'like', "%{$request->q}%")
                    ->orWhere('device_name', 'like', "%{$request->q}%")
                    ->orWhere('browser', 'like', "%{$request->q}%")
                    ->orWhere('platform', 'like', "%{$request->q}%")
                    ->orWhereHas('user', fn ($userQuery) => $userQuery
                        ->where('name', 'like', "%{$request->q}%")
                        ->orWhere('email', 'like', "%{$request->q}%"));
            }))
            ->latest('logged_in_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.login-histories', compact('histories'));
    }
}
