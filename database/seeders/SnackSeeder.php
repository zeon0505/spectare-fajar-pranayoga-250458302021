<?php

namespace Database\Seeders;

use App\Models\Snack;
use Illuminate\Database\Seeder;

class SnackSeeder extends Seeder
{
    public function run(): void
    {
        $snacks = [
            [
                'name' => 'Caramel Popcorn Large',
                'type' => 'Food',
                'price' => 55000,
                'description' => 'Popcorn manis dengan balutan caramel premium.',
                'image' => 'snacks/popcorn-caramel.jpg'
            ],
            [
                'name' => 'Salty Popcorn Large',
                'type' => 'Food',
                'price' => 50000,
                'description' => 'Popcorn klasik dengan rasa asin gurih.',
                'image' => 'snacks/popcorn-salty.jpg'
            ],
            [
                'name' => 'Beef Nachos',
                'type' => 'Food',
                'price' => 45000,
                'description' => 'Keripik jagung renyah dengan saus keju dan daging sapi.',
                'image' => 'snacks/nachos.jpg'
            ],
            [
                'name' => 'Hotdog Deluxe',
                'type' => 'Food',
                'price' => 40000,
                'description' => 'Sosis sapi premium dengan roti lembut dan saus spesial.',
                'image' => 'snacks/hotdog.jpg'
            ],
            [
                'name' => 'Coca Cola 600ml',
                'type' => 'Drink',
                'price' => 25000,
                'description' => 'Minuman bersoda segar.',
                'image' => 'snacks/coke.jpg'
            ],
            [
                'name' => 'Lemon Tea Ice',
                'type' => 'Drink',
                'price' => 28000,
                'description' => 'Teh lemon segar dengan es batu.',
                'image' => 'snacks/lemon-tea.jpg'
            ],
            [
                'name' => 'Mineral Water',
                'type' => 'Drink',
                'price' => 15000,
                'description' => 'Air mineral pegunungan 600ml.',
                'image' => 'snacks/water.jpg'
            ],
        ];

        foreach ($snacks as $snack) {
            Snack::updateOrCreate(['name' => $snack['name']], $snack);
        }
    }
}
