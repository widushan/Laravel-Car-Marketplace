<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);



        // Create car types with the following data using factories
        /*
        [
            'Sedan',
            'Hatchback',
            'SUV',
            'Pickup Truck',
            'Minivan',
            'Jeep',
            'Coupe',
            'Crossover',
            'Sports Car'
        ]
        */

        CarType::factory()
            ->sequence(
                ['name' => 'Sedan'],
                ['name' => 'Hatchback'],
                ['name' => 'SUV'],
                ['name' => 'Pickup Truck'],
                ['name' => 'Minivan'],
                ['name' => 'Jeep'],
                ['name' => 'Coupe'],
                ['name' => 'Crossover'],
                ['name' => 'Sports Car']
            )
            ->count(9)
            ->create();


        // Create fuel types with the following data using factories
        /*
        [
            'Gasoline',
            'Diesel',
            'Electric',
            'Hybrid'
        ]
        */
        FuelType::factory()
            ->sequence(
                ['name' => 'Gasoline'],
                ['name' => 'Diesel'],
                ['name' => 'Electric'],
                ['name' => 'Hybrid'],
            )
            ->count(4)
            ->create();


        // Create States with cities

        $states = [
            'Colombo' => ['Colombo', 'Dehiwala-Mount Lavinia', 'Moratuwa', 'Maharagama', 'Kotte'],
            'Gampaha' => ['Negombo', 'Gampaha', 'Ja-Ela', 'Wattala', 'Kadawatha'],
            'Kalutara' => ['Kalutara', 'Panadura', 'Horana', 'Beruwala', 'Matugama'],
            'Kandy' => ['Kandy', 'Peradeniya', 'Katugastota', 'Gampola', 'Nawalapitiya'],
            'Matale' => ['Matale', 'Dambulla', 'Galewela', 'Ukuwela', 'Rattota'],
            'Nuwara Eliya' => ['Nuwara Eliya', 'Hatton', 'Talawakele', 'Nanu Oya', 'Ginigathhena'],
            'Galle' => ['Galle', 'Ambalangoda', 'Hikkaduwa', 'Elpitiya', 'Baddegama'],
            'Matara' => ['Matara', 'Weligama', 'Dikwella', 'Akuressa', 'Kamburupitiya'],
            'Hambantota' => ['Hambantota', 'Tangalle', 'Tissamaharama', 'Ambalantota', 'Beliatta'],
            'Jaffna' => ['Jaffna', 'Chavakachcheri', 'Point Pedro', 'Nallur', 'Karainagar'],
            'Kilinochchi' => ['Kilinochchi', 'Pallai', 'Paranthan', 'Poonakary', 'Akkarayankulam'],
            'Mannar' => ['Mannar', 'Murunkan', 'Pesalai', 'Madhu', 'Nanattan'],
            'Mullaitivu' => ['Mullaitivu', 'Puthukudiyiruppu', 'Oddusuddan', 'Mankulam', 'Maritimepattu'],
            'Vavuniya' => ['Vavuniya', 'Nedunkeni', 'Cheddikulam', 'Omanthai', 'Puliyankulam'],
            'Batticaloa' => ['Batticaloa', 'Kattankudy', 'Eravur', 'Valaichenai', 'Chenkalady'],
            'Ampara' => ['Ampara', 'Kalmunai', 'Akkaraipattu', 'Sainthamaruthu', 'Pottuvil'],
            'Trincomalee' => ['Trincomalee', 'Kinniya', 'Kantale', 'Mutur', 'Nilaveli'],
            'Kurunegala' => ['Kurunegala', 'Kuliyapitiya', 'Narammala', 'Pannala', 'Mawathagama'],
            'Puttalam' => ['Puttalam', 'Chilaw', 'Wennappuwa', 'Marawila', 'Nattandiya'],
            'Anuradhapura' => ['Anuradhapura', 'Kekirawa', 'Medawachchiya', 'Tambuttegama', 'Mihintale'],
            'Polonnaruwa' => ['Polonnaruwa', 'Kaduruwela', 'Hingurakgoda', 'Medirigiriya', 'Dimbulagala'],
            'Badulla' => ['Badulla', 'Bandarawela', 'Ella', 'Hali-Ela', 'Welimada'],
            'Monaragala' => ['Monaragala', 'Wellawaya', 'Bibile', 'Buttala', 'Kataragama'],
            'Ratnapura' => ['Ratnapura', 'Balangoda', 'Embilipitiya', 'Pelmadulla', 'Eheliyagoda'],
            'Kegalle' => ['Kegalle', 'Mawanella', 'Warakapola', 'Rambukkana', 'Ruwanwella']

        ];

        foreach ($states as $state => $cities) {
            State::factory()
                ->state(['name' => $state])
                ->has(
                    City::factory()
                        ->count(count($cities))
                        ->sequence(...array_map(fn($city) => ['name' => $city], $cities))
                )
                ->create();
        }


        // Create makers with their corresponding models
        $makers = [
            'Toyota' => ['Camry', 'Corolla', 'Highlander', 'RAV4', 'Prius', '4Runner'],
            'Ford' => ['F-150', 'Escape', 'Explorer', 'Mustang', 'Fusion', 'Ranger'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot', 'Odyssey', 'HR-V', 'Ridgeline'],
            'Chevrolet' => ['Silverado', 'Equinox', 'Malibu', 'Impala', 'Cruze'],
            'Nissan' => ['Altima', 'Sentra', 'Rogue', 'Maxima', 'Murano', 'Pathfinder'],
            'Lexus' => ['RX400', 'RX450', 'RX350', 'ES350', 'LS500', 'IS300', 'GX460'],
        ];

        foreach ($makers as $maker => $models) {
            Maker::factory()
                ->state(['name' => $maker])
                ->has(
                    Model::factory()
                        ->count(count($models))
                        ->sequence(...array_map(fn($model) => ['name' => $model], $models))
                )
                ->create();
        }


        // Create users, cars with images and features
        // Create 3 users first, then create 2 more users,
        // and for each user (from the last 2 users) create 50 cars,
        // with images and features and add these cars to favourite cars
        // of these 2 users.

        // Create 3 users
        User::factory()
            ->count(3)
            ->create();

        User::factory()
            ->count(2)
            ->has(
                Car::factory()
                    ->count(50)
                    ->has(
                        CarImage::factory()
                            ->count(5)
                            ->sequence(fn(Sequence $sequence) =>
                                ['position' => $sequence->index + 1]),
                        'images'
                    )
                    ->hasFeatures(),
                'favouriteCars'
            )
            ->create();
    }
}
