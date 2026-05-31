@php $job = $job ?? null; @endphp

<div class="space-y-6">
    <!-- Section: Informasi Dasar -->
    <div class="card p-6">
        <h3 class="font-bold text-ink-900 mb-4 flex items-center gap-2">📝 Informasi Dasar</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Judul Lowongan</label>
                <input type="text" name="title" value="{{ old('title', $job?->title) }}" required class="field" placeholder="mis. Backend Developer (Laravel)">
                @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Kategori</label>
                <select name="category_id" required class="field">
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $job?->category_id) == $category->id)>{{ $category->icon }} {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Status</label>
                <select name="status" required class="field">
                    @foreach (['active'=>'Aktif','draft'=>'Draft','closed'=>'Ditutup'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('status', $job?->status ?? 'active') === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Section: Detail Pekerjaan -->
    <div class="card p-6">
        <h3 class="font-bold text-ink-900 mb-4 flex items-center gap-2">💼 Detail Pekerjaan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Tipe Pekerjaan</label>
                <select name="type" required class="field">
                    @foreach (['full_time'=>'Full Time','part_time'=>'Part Time','freelance'=>'Freelance','internship'=>'Magang','contract'=>'Kontrak'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('type', $job?->type) === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Lokasi Kerja</label>
                <select name="location_type" required class="field">
                    @foreach (['onsite'=>'Onsite','remote'=>'Remote','hybrid'=>'Hybrid'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('location_type', $job?->location_type) === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Kota</label>
                <input type="text" name="city" value="{{ old('city', $job?->city) }}" class="field" placeholder="mis. Bandung">
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Pengalaman</label>
                <select name="experience" required class="field">
                    @foreach (['fresh_graduate'=>'Fresh Graduate','1-2'=>'1-2 Tahun','2-5'=>'2-5 Tahun','5+'=>'5+ Tahun'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('experience', $job?->experience) === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Section: Gaji & Deadline -->
    <div class="card p-6">
        <h3 class="font-bold text-ink-900 mb-4 flex items-center gap-2">💰 Gaji & Deadline</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Gaji Minimum (Rp)</label>
                <input type="number" name="salary_min" value="{{ old('salary_min', $job?->salary_min) }}" class="field" placeholder="5000000">
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Gaji Maksimum (Rp)</label>
                <input type="number" name="salary_max" value="{{ old('salary_max', $job?->salary_max) }}" class="field" placeholder="8000000">
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Deadline</label>
                <input type="date" name="deadline" value="{{ old('deadline', $job?->deadline?->format('Y-m-d')) }}" class="field">
            </div>
            <div class="flex items-end pb-1">
                <label class="inline-flex items-center gap-2.5 cursor-pointer">
                    <input type="hidden" name="salary_visible" value="0">
                    <input type="checkbox" name="salary_visible" value="1" id="salary_visible" @checked(old('salary_visible', $job?->salary_visible ?? true)) class="rounded border-ink-300 text-brand-600 focus:ring-brand-400 w-5 h-5">
                    <span class="text-sm text-ink-700">Tampilkan gaji ke pelamar</span>
                </label>
            </div>
        </div>
    </div>

    <!-- Section: Konten -->
    <div class="card p-6">
        <h3 class="font-bold text-ink-900 mb-4 flex items-center gap-2">📄 Deskripsi & Persyaratan</h3>
        <div class="space-y-5">
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Deskripsi Pekerjaan</label>
                <textarea name="description" rows="5" required class="field">{{ old('description', $job?->description) }}</textarea>
                @error('description')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Persyaratan</label>
                <textarea name="requirements" rows="5" required class="field">{{ old('requirements', $job?->requirements) }}</textarea>
                @error('requirements')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-ink-700 mb-1.5">Benefit (opsional)</label>
                <textarea name="benefits" rows="3" class="field">{{ old('benefits', $job?->benefits) }}</textarea>
            </div>
        </div>
    </div>
</div>
