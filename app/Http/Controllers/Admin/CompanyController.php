<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = CompanyProfile::with('user')
            ->when($request->verified !== null && $request->verified !== '', function ($q) use ($request) {
                $q->where('is_verified', (bool) $request->verified);
            })
            ->when($request->q, fn ($q) => $q->where('company_name', 'like', "%{$request->q}%"))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.companies', compact('companies'));
    }

    public function verify(CompanyProfile $company)
    {
        $company->update(['is_verified' => ! $company->is_verified]);

        return back()->with('success', $company->is_verified ? 'Perusahaan diverifikasi.' : 'Verifikasi dibatalkan.');
    }
}
