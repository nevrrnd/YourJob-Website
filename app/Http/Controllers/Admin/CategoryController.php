<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('jobs')->orderBy('name')->get();

        return view('admin.categories', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories', ['categories' => Category::withCount('jobs')->orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:10'],
        ]);

        Category::create([
            'name' => $data['name'],
            'slug' => $this->uniqueSlug($data['name']),
            'icon' => $data['icon'] ?? null,
        ]);

        return back()->with('success', 'Kategori ditambahkan.');
    }

    public function edit(Category $kategori)
    {
        $categories = Category::withCount('jobs')->orderBy('name')->get();

        return view('admin.categories', ['categories' => $categories, 'editing' => $kategori]);
    }

    public function update(Request $request, Category $kategori)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:10'],
        ]);

        $update = ['name' => $data['name'], 'icon' => $data['icon'] ?? null];
        if ($data['name'] !== $kategori->name) {
            $update['slug'] = $this->uniqueSlug($data['name'], $kategori->id);
        }

        $kategori->update($update);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori diperbarui.');
    }

    public function destroy(Category $kategori)
    {
        if ($kategori->jobs()->exists()) {
            return back()->with('warning', 'Kategori masih dipakai lowongan, tidak dapat dihapus.');
        }

        $kategori->delete();

        return back()->with('success', 'Kategori dihapus.');
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;

        while (Category::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
