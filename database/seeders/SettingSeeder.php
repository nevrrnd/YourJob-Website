<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // --- General / Branding ---
            ['key' => 'site_name',        'value' => 'YourJob',                          'group' => 'general', 'type' => 'text'],
            ['key' => 'site_tagline',     'value' => 'Temukan pekerjaan yang tepat untukmu', 'group' => 'general', 'type' => 'text'],
            ['key' => 'hero_title',       'value' => 'Temukan pekerjaan yang tepat untukmu', 'group' => 'general', 'type' => 'text'],
            ['key' => 'hero_subtitle',    'value' => 'Ribuan peluang karier dari perusahaan terverifikasi. Cari, lamar, dan kembangkan kariermu dalam satu platform.', 'group' => 'general', 'type' => 'textarea'],

            // --- Contact / Footer ---
            ['key' => 'contact_email',    'value' => 'support@yourjob.com',              'group' => 'contact', 'type' => 'email'],
            ['key' => 'contact_phone',    'value' => '',                                  'group' => 'contact', 'type' => 'text'],
            ['key' => 'contact_address',  'value' => '',                                  'group' => 'contact', 'type' => 'textarea'],
            ['key' => 'footer_text',      'value' => 'Platform lowongan kerja terpercaya untuk menghubungkan talenta dengan perusahaan terbaik.', 'group' => 'contact', 'type' => 'textarea'],
            ['key' => 'social_facebook',  'value' => '',                                  'group' => 'contact', 'type' => 'text'],
            ['key' => 'social_instagram', 'value' => '',                                  'group' => 'contact', 'type' => 'text'],
            ['key' => 'social_linkedin',  'value' => '',                                  'group' => 'contact', 'type' => 'text'],

            // --- Behaviour / Functionality ---
            ['key' => 'jobs_per_page',        'value' => '10',  'group' => 'functionality', 'type' => 'number'],
            ['key' => 'allow_registration',   'value' => '1',   'group' => 'functionality', 'type' => 'boolean'],
            ['key' => 'allow_employer_register', 'value' => '1', 'group' => 'functionality', 'type' => 'boolean'],
            ['key' => 'auto_verify_company',  'value' => '0',   'group' => 'functionality', 'type' => 'boolean'],

            // --- Maintenance ---
            ['key' => 'maintenance_mode',     'value' => '0',   'group' => 'maintenance', 'type' => 'boolean'],
            ['key' => 'maintenance_message',  'value' => 'Situs sedang dalam pemeliharaan. Silakan kembali beberapa saat lagi.', 'group' => 'maintenance', 'type' => 'textarea'],
        ];

        foreach ($defaults as $row) {
            Setting::firstOrCreate(['key' => $row['key']], $row);
        }

        Setting::flushCache();
    }
}
