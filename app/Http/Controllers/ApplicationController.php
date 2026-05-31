<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // ---- Seeker: riwayat lamaran ----
    public function index()
    {
        $applications = Application::with(['job.employer.companyProfile'])
            ->where('seeker_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('dashboard.applications', compact('applications'));
    }

    // ---- Seeker: lamar pekerjaan ----
    public function store(Request $request, Job $job)
    {
        abort_if(
            Application::where(['job_id' => $job->id, 'seeker_id' => auth()->id()])->exists(),
            422,
            'Anda sudah melamar lowongan ini.'
        );

        $request->validate([
            'cv_file' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'cover_letter' => ['nullable', 'string'],
        ]);

        $cv = $request->file('cv_file')->store('cv', 'public');

        Application::create([
            'job_id' => $job->id,
            'seeker_id' => auth()->id(),
            'cv_file' => $cv,
            'cover_letter' => $request->cover_letter,
        ]);

        return back()->with('success', 'Lamaran terkirim!');
    }

    // ---- Employer: lihat pelamar per lowongan ----
    public function applicants(Job $job)
    {
        abort_if($job->employer_id !== auth()->id(), 403);

        $applications = $job->applications()
            ->with('seeker.seekerProfile')
            ->latest()
            ->get();

        return view('jobs.applicants', compact('job', 'applications'));
    }

    // ---- Employer: update status lamaran ----
    public function updateStatus(Request $request, Application $application)
    {
        abort_if($application->job->employer_id !== auth()->id(), 403);

        $request->validate([
            'status' => ['required', 'in:pending,reviewed,interview,accepted,rejected'],
            'employer_note' => ['nullable', 'string'],
        ]);

        $application->update([
            'status' => $request->status,
            'employer_note' => $request->employer_note,
        ]);

        return back()->with('success', 'Status lamaran diperbarui.');
    }
}
