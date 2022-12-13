<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Locations;
use App\Models\OperatingSystem;
use Illuminate\Http\Request;
use App\Models\HardwareAssets;
use Illuminate\Support\Carbon;

class HardwareAssetsController extends Controller
{
    //
    public function edit($id)
     {
            $hardware = HardwareAssets::find($id);
            $manufacturers = Companies::all()->pluck('name', 'id')->toArray();
            $operating_systems = OperatingSystem::all()->pluck('os_name', 'id')->toArray();
            $locations = Locations::all()->pluck('name', 'id')->toArray();
            return view('hardware-edit',['hardware' => $hardware, 'manufacturers' => $manufacturers, 'operating_systems' => $operating_systems, 'locations' => $locations]);
     }
     public function create()
     {
            $hardware = HardwareAssets::all();
            $manufacturers = Companies::all()->pluck('name', 'id')->toArray();
            $operating_systems = OperatingSystem::all()->pluck('os_name', 'id')->toArray();
            $locations = Locations::all()->pluck('name', 'id')->toArray();
            return view('add-hardware',['hardware' => $hardware, 'manufacturers' => $manufacturers, 'operating_systems' => $operating_systems, 'locations' => $locations]);
     }


     public function update(Request $request, $id)
     {
            $hardware = HardwareAssets::find($id);
            $hardware->companies = $request->Input('company');
            $hardware->model = $request->Input('model');
            $hardware->serial_number = $request->Input('serial_number');
            $hardware->purchase_date = Carbon::createFromFormat('m/d/Y', $request->Input('purchase_date'));
            $hardware->warranty_date = Carbon::createFromFormat('m/d/Y', $request->Input('warranty_date'));
            $hardware->purchase_price = str_replace( ',', '', $request->Input('purchase_price'));
            $hardware->version = $request->Input('operating_system');
            $hardware->lifecycle_phase = $request->Input('lifecycle_phase');
            $hardware->location = $request->Input('location');
            $hardware->users = $request->Input('assigned_to');
            $hardware->save();
            return redirect('/hardware')->with('success', 'Asset has been updated');
     }
     
}
