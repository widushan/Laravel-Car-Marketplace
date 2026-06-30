<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-form', [
            'makers' => \App\Models\Maker::orderBy('name')->get(),
            'models' => \App\Models\Model::orderBy('name')->get(),
            'states' => \App\Models\State::orderBy('name')->get(),
            'cities' => \App\Models\City::orderBy('name')->get(),
            'carTypes' => \App\Models\CarType::orderBy('name')->get(),
            'fuelTypes' => \App\Models\FuelType::orderBy('name')->get(),
        ]);
    }


}
