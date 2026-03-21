<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studios = [
            [
                'name' => 'Studio 1',
                'capacity' => 64,
                'layout' => [
                    "SSSS_SSSS",
                    "SSSS_SSSS",
                    "SSSS_SSSS",
                    "SSSS_SSSS",
                    "SSSS_SSSS",
                    "SSSS_SSSS",
                    "SSSS_SSSS",
                    "SSSS_SSSS",
                ]
            ],
            [
                'name' => 'Studio 2',
                'capacity' => 48,
                'layout' => [
                    "SSS__SSS",
                    "SSS__SSS",
                    "SSS__SSS",
                    "SSS__SSS",
                    "SSSSSSSS",
                    "SSSSSSSS",
                ]
            ],
            [
                'name' => 'Studio 3',
                'capacity' => 81,
                'layout' => [
                    "SSSSSSSSS",
                    "SSSSSSSSS",
                    "SSSSSSSSS",
                    "SSSSSSSSS",
                    "SSSSSSSSS",
                    "SSSSSSSSS",
                    "SSSSSSSSS",
                    "SSSSSSSSS",
                    "SSSSSSSSS",
                ]
            ],
            [
                'name' => 'Premiere Lounge',
                'capacity' => 24,
                'layout' => [
                    "SS__SS",
                    "SS__SS",
                    "SS__SS",
                    "SS__SS",
                    "SS__SS",
                    "SS__SS",
                ]
            ],
        ];

        foreach ($studios as $studioData) {
            Studio::updateOrCreate(
                ['name' => $studioData['name']],
                [
                    'capacity' => $studioData['capacity'],
                    'layout' => $studioData['layout'],
                ]
            );
        }
    }
}
