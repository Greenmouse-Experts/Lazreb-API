<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createVehicleType = [
            [
                'type' => 'Coaster',
                'price' => '₦60,000 - ₦70,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'New Coaster',
                'price' => '₦150,000 - ₦160,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'Toyota Hiace',
                'price' => '₦50,000 - ₦60,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'Sienna/Routan',
                'price' => '₦40,000 - ₦50,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'Toyota Hilux',
                'price' => '₦40,000 - ₦50,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'Toyota Venza',
                'price' => '₦40,000 - ₦50,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'Honda Accord',
                'price' => '₦30,000 - ₦40,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'Camry Musle',
                'price' => '₦25,000 - ₦35,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'Toyota Corrola',
                'price' => '₦25,000 - ₦35,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'SUV Prado',
                'price' => '₦80,000 - ₦90,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'Toyota Landcruiser',
                'price' => '₦100,000 - ₦120,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
            [
                'type' => 'Lexus Landcruiser LX',
                'price' => '₦100,000 - ₦120,000 Per Day',
                'created_at' => now(),
                'updated_at' =>now()
            ],
        ];

        \App\Models\VehicleType::insert($createVehicleType);
    }
}