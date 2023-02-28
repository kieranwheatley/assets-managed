<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locations;

class LocationsController extends Controller
{


   public function insert()
    {
              $location = new Locations();
              $location->name = request('name');
              $location->address = request('address');
              $location->city = request('city');
              $location->postcode = request('postcode');
              $location->country = request('country');
              $location->latitude = request('latitude');
              $location->longitude = request('longitude');
              $location->save();
              return redirect('/locations')->with('success', 'Location has been added');
    }
}
