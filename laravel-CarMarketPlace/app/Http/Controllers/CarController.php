<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\CarImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = request()->user()
            ->cars()
            ->with(['primaryImage', 'maker', 'model'])
            ->orderBy("created_at", 'desc')
            ->paginate(10);
        return view('car.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car.create', [
            'makers'    => \App\Models\Maker::orderBy('name')->get(),
            'models'    => \App\Models\Model::orderBy('name')->get(),
            'states'    => \App\Models\State::orderBy('name')->get(),
            'cities'    => \App\Models\City::orderBy('name')->get(),
            'carTypes'  => \App\Models\CarType::orderBy('name')->get(),
            'fuelTypes' => \App\Models\FuelType::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'maker_id' => 'required|exists:makers,id',
            'model_id' => 'required|exists:models,id',
            'year' => 'required|integer|min:1990|max:' . date('Y'),
            'price' => 'required|integer|min:0',
            'vin' => 'required|string|max:255',
            'mileage' => 'required|integer|min:0',
            'car_type_id' => 'required|exists:car_types,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:45',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = $request->user()->id;
        if ($request->filled('published')) {
            $validated['published_at'] = now();
        }

        $car = Car::create($validated);

        // Store features
        $featureFields = [
            'abs', 'air_conditioning', 'power_windows', 'power_door_locks', 
            'cruise_control', 'bluetooth_connectivity', 'remote_start', 
            'gps_navigation', 'heated_seats', 'climate_control', 
            'rear_parking_sensors', 'leather_seats'
        ];

        $featuresData = [];
        foreach ($featureFields as $field) {
            $featuresData[$field] = $request->boolean($field);
        }
        $car->features()->create($featuresData);

        // Store images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                                $path = $file->store('cars', 'cloudinary');
                $url = Storage::url($path);
                $car->images()->create([
                    'image_path' => $url,
                    'position' => $index + 1,
                ]);
            }
        }

        return redirect()->route('car.show', $car)->with('success', 'Car successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('car.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('car.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }

    public function search(Request $request)
    {
        $query = Car::where('published_at', '<', now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model']);

        if ($request->filled('maker_id')) {
            $query->where('maker_id', $request->maker_id);
        }
        if ($request->filled('model_id')) {
            $query->where('model_id', $request->model_id);
        }
        if ($request->filled('state_id')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('state_id', $request->state_id);
            });
        }
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        if ($request->filled('car_type_id')) {
            $query->where('car_type_id', $request->car_type_id);
        }
        if ($request->filled('fuel_type_id')) {
            $query->where('fuel_type_id', $request->fuel_type_id);
        }
        if ($request->filled('year_from')) {
            $query->where('year', '>=', $request->year_from);
        }
        if ($request->filled('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort === 'year_desc') {
                $query->orderBy('year', 'desc');
            } elseif ($request->sort === 'year_asc') {
                $query->orderBy('year', 'asc');
            } else {
                $query->orderBy('published_at', 'desc');
            }
        } else {
            $query->orderBy('published_at', 'desc');
        }

        $cars = $query->paginate(15)->withQueryString();

        return view('car.search', ['cars' => $cars]);
    }


    public function watchlist()
    {

        $cars = request()->user()
            ->favouriteCars()
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->paginate(10);

        return view('car.watchlist', ['cars' => $cars]);
    }


    public function addWatchlist(Car $car)
    {
        $user = request()->user();
        $user->favouriteCars()->toggle($car->id);
        return response()->json(['status' => 'success']);
    }
}
