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
    public function edit($id)
    {
        $location = Locations::find($id);
        return view('location-edit', compact('location'));
    }

    public function update(Request $request, $id)
        {
            $location = Locations::find($id);
            $location->name = $request->Input('name');
            $location->address = $request->Input('address');
            $location->city = $request->Input('city');
            $location->postcode = $request->Input('postcode');
            $location->country = $request->Input('country');
            $location->latitude = $request->Input('latitude');
            $location->longitude = $request->Input('longitude');
            $location->save();
            return redirect('/locations')->with('success', 'Location has been updated');
        }
        public function remove($id)
       {
              $location = Locations::find($id);
              $location->delete();
              return redirect('/locations')->with('success', 'Location has been removed');
       }
}
