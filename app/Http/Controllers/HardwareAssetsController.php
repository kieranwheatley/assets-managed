<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Companies;
use App\Models\Locations;
use App\Models\OperatingSystem;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Models\HardwareAssets;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class HardwareAssetsController extends Controller
{
       //
       public function checkCVE($company, $model)
       {
              $response = Http::get('https://services.nvd.nist.gov/rest/json/cves/2.0', [
              'keywordSearch' => $company . " " . $model,]);
              return $response->json();
       }

       public function edit($id)
       
       {
              $users = User::all()->pluck('email', 'id')->toArray();
              $hardware = HardwareAssets::find($id); 
              $manufacturers = Companies::all()->pluck('name', 'id')->toArray();
              $operating_systems = OperatingSystem::all()->pluck('os_name', 'id')->toArray();
              $locations = Locations::all()->pluck('name', 'id')->toArray();
              return view('hardware-edit', ['hardware' => $hardware, 'manufacturers' => $manufacturers, 'operating_systems' => $operating_systems, 'locations' => $locations, 'users' => $users]);
       }
       public function create()
       {
              $hardware = HardwareAssets::all();
              $manufacturers = Companies::all()->pluck('name', 'id')->toArray();
              $operating_systems = OperatingSystem::all()->pluck('os_name', 'id')->toArray();
              $locations = Locations::all()->pluck('name', 'id')->toArray();
              $user = User::all()->pluck('first_name', 'id')->toArray();
              return view('add-hardware', ['hardware' => $hardware, 'manufacturers' => $manufacturers, 'operating_systems' => $operating_systems, 'locations' => $locations, 'user' => $user]);
       }
       public function insert()
       {
              $hardware = new HardwareAssets();
              $hardware->asset = "1";
              $hardware->companies = request('company');
              $hardware->model = request('model');
              $hardware->serial_number = request('serial_number');
              $hardware->purchase_date = request('purchase_date');
              $hardware->warranty_date = request('warranty_date');
              $hardware->purchase_price = str_replace(',', '', request('purchase_price'));
              //$hardware->version = request('operating_system');
              $hardware->version = "1";
              $hardware->lifecycle_phase = request('lifecycle_phase');
              $hardware->location = request('location');
              $hardware->users = request('assigned_to');

              $company_name = Companies::where('id', request('company'))->get();
              $company = $company_name[0]->name;

              $response = $this->checkCVE($company, request('model'), request('serial_number'));
              //dd($response);
              if ($response['totalResults'] > 0)
              {
                     $hardware->has_CVE = true;
                     $hardware->CVE_details = json_encode($response['vulnerabilities']);
                     //$hardware->highest_CVE_severity = $response['result']['CVE_Items'][0]['impact']['baseMetricV3']['cvssV3']['baseSeverity'];
              }
              else
              {
                     $hardware->has_CVE = false;
                     $hardware->CVE_details = null;
                     $hardware->highest_CVE_severity = null;
              }
              //dd($hardware->CVE_details);
              $hardware->save();
              return redirect('/hardware')->with('success', 'Hardware asset has been added');
       }


       public function update(Request $request, $id)
       {
              $hardware = HardwareAssets::find($id);
              $hardware->companies = $request->Input('company');
              $hardware->model = $request->Input('model');
              $hardware->serial_number = $request->Input('serial_number');
              if (str_contains(request('purchase_date'), '-')) 
              {
                     $hardware->purchase_date = "test";
              }
              else
              {
                     $hardware->purchase_date = Carbon::createFromFormat('m-d-Y', request('purchase_date'));
              }
              // if (str_contains(request('purchase_date'), '-')){
              // {
              //        $hardware->purchase_date = Carbon::createFromFormat('m-d-Y', request('purchase_date'));
              // }}
              $hardware->purchase_date = $request->Input('purchase_date');
              $hardware->warranty_date = $request->Input('warranty_date');
              $hardware->purchase_price = str_replace(',', '', $request->Input('purchase_price'));
              $hardware->lifecycle_phase = $request->Input('lifecycle_phase');
              $hardware->location = $request->Input('location');

              $hardware->users = $request->Input('assigned_to');
              $hardware->save();
              return redirect('/hardware')->with('success', 'Asset has been updated');
       }

       public function remove($id)
       {
              $hardware = HardwareAssets::find($id);
              $hardware->delete();
              return redirect('/hardware')->with('success', 'Asset has been removed');
       }

       function add() 
       {
              $hardware = new HardwareAssets();
              $hardware->asset = "1";
              $hardware->companies = "1";
              $hardware->model = request('model');
              $hardware->serial_number = "19549-49503-494390-MA";
              $hardware->purchase_price = "0.00";
              $hardware->version = "1";
              $hardware->lifecycle_phase = 'active';
              $hardware->location = "1";
              $hardware->host_name = request('host_name');
              $hardware->product_id = request('product_id');
              $hardware->last_boot_time = request('last_boot_time');
              $hardware->purchase_date = Carbon::now();
              $hardware->warranty_date = Carbon::now();
              $hardware->encryption_status = request('encryption_status');
              $hardware->users = "2";
              $hardware->save();

              logger("Test");
              return ["Result" => "Success"];
       }

       
}