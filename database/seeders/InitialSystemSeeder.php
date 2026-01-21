<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolProfile;
use App\Models\VisualIdentity;

class InitialSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan record profil sekolah ada dengan nama default
        SchoolProfile::updateOrCreate(
            ['id' => 1],
            [
                'nama_sekolah' => 'MTs Nurul Falaah Soreang',
            ]
        );

        // Pastikan record identitas visual ada (meskipun path logo masih kosong)
        VisualIdentity::updateOrCreate(
            ['id' => 1],
            [
                'show_logo' => true,
                'show_title' => true,
            ]
        );
    }
}
