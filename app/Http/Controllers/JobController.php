<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index()
    {
        return redirect()->route('employer.dashboard');
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('jobs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['employer_id'] = auth()->id();
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['salary_visible'] = $request->boolean('salary_visible');

        Job::create($data);

        return redirect()->route('employer.dashboard')->with('success', 'Lowongan berhasil diposting.');
    }

    public function show(Job $job)
    {
        abort_if($job->employer_id !== auth()->id(), 403);

        return redirect()->route('jobs.show', $job);
    }

    public function edit(Job $job)
    {
        abort_if($job->employer_id !== auth()->id(), 403);

        $categories = Category::orderBy('name')->get();

        return view('jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, Job $job)
    {
        abort_if($job->employer_id !== auth()->id(), 403);

        $data = $this->validateData($request);
        $data['salary_visible'] = $request->boolean('salary_visible');

        if ($data['title'] !== $job->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $job->id);
        }

        $job->update($data);

        return redirect()->route('employer.dashboard')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Job $job)
    {
        abort_if($job->employer_id !== auth()->id(), 403);

        $job->delete();

        return back()->with('success', 'Lowongan dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string'],
            'requirements' => ['required', 'string'],
            'benefits' => ['nullable', 'string'],
            'type' => ['required', 'in:full_time,part_time,freelance,internship,contract'],
            'location_type' => ['required', 'in:onsite,remote,hybrid'],
            'city' => ['nullable', 'string', 'max:255'],
            'salary_min' => ['nullable', 'numeric'],
            'salary_max' => ['nullable', 'numeric'],
            'experience' => ['required', 'in:fresh_graduate,1-2,2-5,5+'],
            'status' => ['required', 'in:active,closed,draft'],
            'deadline' => ['nullable', 'date'],
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (Job::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
