<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companies;

class CompaniesController extends Controller
{
    public function insert()
    {
        $company = new Companies();
        $company->name = request('name');
        $company->save();
        return redirect('/companies')->with('success', 'Company has been added');
    }
}
