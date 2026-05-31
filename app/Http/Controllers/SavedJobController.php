<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SavedJobController extends Controller
{
    public function index()
    {
        $jobs = auth()->user()->savedJobs()
            ->with(['employer.companyProfile', 'category'])
            ->latest('saved_jobs.created_at')
            ->paginate(10);

        return view('dashboard.saved', compact('jobs'));
    }

    public function toggle(Request $request, Job $job)
    {
        $result = auth()->user()->savedJobs()->toggle($job->id);
        $saved = count($result['attached']) > 0;

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['saved' => $saved]);
        }

        return back()->with('success', $saved ? 'Lowongan disimpan.' : 'Lowongan dihapus dari simpanan.');
    }
}
