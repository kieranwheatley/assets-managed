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
    public function edit($id)
    {
        $company = Companies::find($id);
        return view('companies-edit', compact('company'));
    }
    public function update(Request $request, $id)
    {
        $company = Companies::find($id);
        $company->name = $request->Input('name');
        $company->save();
        return redirect('/companies')->with('success', 'Company has been updated');
    }
    public function remove($id)
    {
        $company = Companies::find($id);
        $company->delete();
        return redirect('/companies')->with('success', 'Company has been removed');
    }
}
