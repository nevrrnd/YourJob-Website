<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['Teknologi & IT', 'teknologi-it', '💻'],
            ['Desain & Kreatif', 'desain-kreatif', '🎨'],
            ['Marketing & Sales', 'marketing-sales', '📢'],
            ['Keuangan', 'keuangan', '💰'],
            ['Pendidikan', 'pendidikan', '📚'],
            ['Kesehatan', 'kesehatan', '🏥'],
            ['Logistik', 'logistik', '🚚'],
            ['Lainnya', 'lainnya', '📋'],
        ];

        foreach ($categories as [$name, $slug, $icon]) {
            Category::updateOrCreate(['slug' => $slug], ['name' => $name, 'icon' => $icon]);
        }
    }
}
