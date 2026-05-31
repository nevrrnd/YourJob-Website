<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Settings definition — drives both validation and the form UI.
     * Grouped by tab.
     *
     * @return array<string, array>
     */
    private function schema(): array
    {
        return [
            'general' => [
                'label' => 'Umum & Branding',
                'icon' => '🏷️',
                'fields' => [
                    'site_name'     => ['label' => 'Nama Situs', 'type' => 'text', 'rules' => 'required|string|max:255'],
                    'site_tagline'  => ['label' => 'Tagline', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
                    'site_logo'     => ['label' => 'Logo Situs', 'type' => 'image', 'rules' => 'nullable|image|max:2048', 'hint' => 'PNG/JPG, maks 2MB. Kosongkan untuk pakai logo bawaan.'],
                    'hero_title'    => ['label' => 'Judul Hero (Beranda)', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
                    'hero_subtitle' => ['label' => 'Subjudul Hero', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                ],
            ],
            'contact' => [
                'label' => 'Kontak & Footer',
                'icon' => '📧',
                'fields' => [
                    'contact_email'    => ['label' => 'Email Kontak', 'type' => 'email', 'rules' => 'nullable|email|max:255'],
                    'contact_phone'    => ['label' => 'Telepon', 'type' => 'text', 'rules' => 'nullable|string|max:50'],
                    'contact_address'  => ['label' => 'Alamat', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                    'footer_text'      => ['label' => 'Teks Footer', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                    'social_facebook'  => ['label' => 'URL Facebook', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
                    'social_instagram' => ['label' => 'URL Instagram', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
                    'social_linkedin'  => ['label' => 'URL LinkedIn', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
                ],
            ],
            'functionality' => [
                'label' => 'Fungsionalitas',
                'icon' => '⚙️',
                'fields' => [
                    'jobs_per_page'        => ['label' => 'Lowongan per Halaman', 'type' => 'number', 'rules' => 'required|integer|min:3|max:50'],
                    'allow_registration'   => ['label' => 'Izinkan Pendaftaran Pengguna', 'type' => 'boolean', 'rules' => 'nullable|boolean'],
                    'allow_employer_register' => ['label' => 'Izinkan Pendaftaran Employer', 'type' => 'boolean', 'rules' => 'nullable|boolean'],
                    'auto_verify_company'  => ['label' => 'Verifikasi Perusahaan Otomatis', 'type' => 'boolean', 'rules' => 'nullable|boolean', 'hint' => 'Jika aktif, perusahaan baru langsung terverifikasi tanpa persetujuan admin.'],
                ],
            ],
            'maintenance' => [
                'label' => 'Mode Pemeliharaan',
                'icon' => '🚧',
                'fields' => [
                    'maintenance_mode'    => ['label' => 'Aktifkan Mode Pemeliharaan', 'type' => 'boolean', 'rules' => 'nullable|boolean', 'hint' => 'Pengunjung non-admin akan melihat halaman pemeliharaan.'],
                    'maintenance_message' => ['label' => 'Pesan Pemeliharaan', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                ],
            ],
        ];
    }

    public function index()
    {
        return view('admin.settings', [
            'schema' => $this->schema(),
            'values' => Setting::all(),
        ]);
    }

    public function update(Request $request, string $group)
    {
        $schema = $this->schema();
        abort_unless(isset($schema[$group]), 404);

        $fields = $schema[$group]['fields'];

        // Build validation rules for this group only.
        $rules = [];
        foreach ($fields as $key => $field) {
            $rules[$key] = $field['rules'];
        }
        $validated = $request->validate($rules);

        foreach ($fields as $key => $field) {
            if ($field['type'] === 'image') {
                if ($request->hasFile($key)) {
                    // Remove previous image if any.
                    $old = Setting::get($key);
                    if ($old && Storage::disk('public')->exists($old)) {
                        Storage::disk('public')->delete($old);
                    }
                    Setting::put($key, $request->file($key)->store('settings', 'public'));
                }

                continue;
            }

            if ($field['type'] === 'boolean') {
                Setting::put($key, $request->boolean($key));

                continue;
            }

            Setting::put($key, $validated[$key] ?? null);
        }

        return back()->with('success', 'Pengaturan "' . $schema[$group]['label'] . '" disimpan.');
    }
}
