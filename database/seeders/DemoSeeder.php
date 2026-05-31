<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Job;
use App\Models\SeekerProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Employer + verified company ----
        $employer = User::updateOrCreate(
            ['email' => 'employer@yourjob.com'],
            ['name' => 'PT Maju Teknologi', 'password' => Hash::make('password'), 'role' => 'employer', 'is_active' => true]
        );

        CompanyProfile::updateOrCreate(
            ['user_id' => $employer->id],
            [
                'company_name' => 'PT Maju Teknologi',
                'slug' => 'pt-maju-teknologi',
                'industry' => 'Teknologi Informasi',
                'city' => 'Jakarta',
                'description' => 'Perusahaan teknologi yang berfokus pada pengembangan produk digital inovatif.',
                'is_verified' => true,
            ]
        );

        // ---- Seeker + profile ----
        $seeker = User::updateOrCreate(
            ['email' => 'seeker@yourjob.com'],
            ['name' => 'Budi Santoso', 'password' => Hash::make('password'), 'role' => 'seeker', 'is_active' => true]
        );

        SeekerProfile::updateOrCreate(
            ['user_id' => $seeker->id],
            ['phone' => '081234567890', 'city' => 'Bandung', 'bio' => 'Fresh graduate yang antusias di bidang teknologi.', 'skills' => ['PHP', 'Laravel', 'MySQL']]
        );

        // ---- Sample jobs ----
        $itCategory = Category::where('slug', 'teknologi-it')->first();
        $designCategory = Category::where('slug', 'desain-kreatif')->first();

        if ($itCategory) {
            $jobs = [
                [
                    'title' => 'Backend Developer (Laravel)',
                    'category_id' => $itCategory->id,
                    'description' => 'Membangun dan memelihara REST API menggunakan Laravel.',
                    'requirements' => "Menguasai PHP & Laravel\nPaham REST API\nFamiliar dengan MySQL",
                    'benefits' => "Gaji kompetitif\nBPJS\nWFH fleksibel",
                    'type' => 'full_time',
                    'location_type' => 'hybrid',
                    'city' => 'Jakarta',
                    'salary_min' => '8000000',
                    'salary_max' => '15000000',
                    'experience' => '1-2',
                ],
                [
                    'title' => 'UI/UX Designer',
                    'category_id' => $designCategory?->id ?? $itCategory->id,
                    'description' => 'Mendesain antarmuka produk digital yang intuitif.',
                    'requirements' => "Menguasai Figma\nPortofolio desain\nPaham design system",
                    'benefits' => "Gaji kompetitif\nLaptop disediakan",
                    'type' => 'full_time',
                    'location_type' => 'remote',
                    'city' => 'Bandung',
                    'salary_min' => '7000000',
                    'salary_max' => '12000000',
                    'experience' => 'fresh_graduate',
                ],
            ];

            foreach ($jobs as $data) {
                Job::updateOrCreate(
                    ['slug' => Str::slug($data['title'])],
                    array_merge($data, [
                        'employer_id' => $employer->id,
                        'salary_visible' => true,
                        'status' => 'active',
                    ])
                );
            }
        }
    }
}
