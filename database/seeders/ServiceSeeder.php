<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [ 
        ['name' => 'Bath and Brush', 'price' => '35'],
        ['name' => 'Full Grooming', 'price' => '80'],
        ['name' => 'Nail Trimming', 'price' => '15'],
        ['name' => 'Pet Photography', 'price' => '150'],
    ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                ['price' => $service['price']]
            );
        }
    }
}