<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CategoryActionsController extends Controller
{
    public function getCountries()
    {
        $countries_get = Http::get('https://api.first.org/data/v1/countries?region=South America');
        
        return $countries_get;
    }
}
