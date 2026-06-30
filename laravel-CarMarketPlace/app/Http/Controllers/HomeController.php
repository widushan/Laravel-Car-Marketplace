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

        $cars = Car::where('published_at', '<', now())
            ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'model'])
            ->orderBy('created_at', 'desc')
            ->limit(30)
            ->get();

        return view('home.index', ['cars' => $cars]);

    }

}
