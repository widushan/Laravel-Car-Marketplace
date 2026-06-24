<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\Maker;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function index()
    {

        /* $car = new Car();

        $car->id = 1;
        $car->maker_id = 1;
        $car->model_id = 1;
        $car->year = 1990;
        $car->price = 10000000;
        $car->vin = 123;
        $car->mileage = 123;
        $car->car_type_id = 1;
        $car->fuel_type_id = 1;
        $car->user_id = 1;
        $car->city_id = 1;
        $car->address = "Lorem ipsum";
        $car->phone = "1234567809";
        $car->description = null;
        $car->created_at = now();
        $car->updated_at = now();
        $car->save(); */

        /* $carData = [
            'id' => 1,
            'maker_id' => 1,
            'model_id' => 1,
            'year' => 1990,
            'price' => 10000000,
            'vin' => 123,
            'mileage' => 123,
            'car_type_id' => 1,
            'fuel_type_id' => 1,
            'user_id' => 1,
            'city_id' => 1,
            'address' => "Lorem ipsum",
            'phone' => 1234567809,
            'description' => null,
            'published_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]; */



        // Approach 1
        //$car = Car::create($carData);

        /* // Approach 2
        $car2 = new Car();
        $car2->fill($carData);
        $car2->save();

        // Approach 3
        $car3 = new Car($carData);
        $car3->save(); */

        // $car = Car::find(1);
        // $car->price = 1000;
        // $car->save();

        // $car = Car::updateOrCreate(
        //     ['vin' => '999', 'price' => 20000],
        //     $carData
        // );

        // Car::where('published_at', null)
        // ->where('user_id', 1)
        // ->update(['published_at' => now()]);

        // $car = Car::find(1);
        // $car->delete();

        //Car:destroy(2,3);

        // Car::where('published_at', null)
        // ->where('user_id', 1)
        // ->delete();

        //Car::truncate();





        // // Challenge : Retrieve all Car records where the prce is greater than 20000
        // $cars = Car::where('price', '>', 20000)->get();

        // // Challenge: Fetch the Maker details where the Maker name is 'Toyota'.
        // $maker = Maker::where('name', 'Toyota')->first();

        // // Challenge: Insert a new FuelType with the name 'Electric'.
        // FuelType::create(['name' => 'Electric']);

        // // Challenge: Update the price of the Car with id 1 to $15,000.
        // Car::where('id', 1)->update(['price' => 15000]);

        // // Challenge: Delete all Car records where the year is before 2020.
        // Car::where('year', '<', 2020)->delete();




        //$car = Car::find(1);

        //$car->features->abs = 0;
        //$car->features->save();

        // $car->features->update(['abs' => 0]);

        // $car->primaryImage->delete();

        // $car = Car::find(2);

        // $carFeatures = new CarFeatures([
        //     'abs' => false,
        //     'air_conditioning' => false,
        //     'power_windows' => false,
        //     'power_door_locks' => false,
        //     'cruise_control' => false,
        //     'bluetooth_connectivity' => false,
        //     'remote_start' => false,
        //     'gps_navigation' => false,
        //     'heated_seats' => false,
        //     'climate_control' => false,
        //     'rear_parking_sensors' => false,
        //     'leather_seats' => false,
        // ]);

        // $car->features()->save($carFeatures);

        //$car = Car::find(1);

        // Create new image
        // $image = new CarImage(['image_path' => 'something', 'position' => 2]);
        // $car->images()->save($image);
        // $car->images()->create(['image_path' => 'something 2', 'position' => 3]);

        // $car->images()->saveMany([
        //     new CarImage(['image_path' => 'something', 'position' => 4]),
        //     new CarImage(['image_path' => 'something', 'position' => 5]),
        // ]);

        // $car->images()->createMany([
        //     ['image_path' => 'something 3', 'position' => 6],
        //     ['image_path' => 'something 4', 'position' => 7],
        // ]);


        // $carType = CarType::where('name', 'Hatchback')->first();
        // $cars = $carType->cars;
        // $cars = Car::whereBelongsTo($carType)->get();

        // $car = Car::find(1);
        // $carType = CarType::where('name', 'Sedan')->first();

        // $car->car_type_id = $carType->id;
        // $car->save();

        // $car->carType()->associate($carType);
        // $car->save();



        // $maker = Maker::factory()->create();

        // Maker::factory()
        //     ->count(10)
        //     ->state([
        //         'name' => 'Pasindu'
        //     ])
        //     ->create();


        // Maker::factory()
        //     ->count(5)
        //     ->hasModels(5)
        //     ->create();


        User::factory()
            ->has(Car::factory()->count(5), 'favouriteCars')
            //    ->hasAttached(Car::factory()->count(5), ['col1' =>'va' ], 'favouriteCars')
            ->create();


        return view('home.index');

    }

}
