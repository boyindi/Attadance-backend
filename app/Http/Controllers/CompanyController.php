<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;



class CompanyController extends Controller
{
    //show
    public function show($id)
{
    $company = Company::findOrFail($id); // gunakan ID dari URL
    return view('pages.company.show', compact('company'));
}

public function edit($id)
{
    $company = Company::findOrFail($id); // gunakan ID dari URL
    return view('pages.company.edit', compact('company'));
}

public function update(Request $request, $id) // pakai ID, bukan model binding
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        'radius_km' => 'required',
        'time_in' => 'required',
        'time_out' => 'required',
        // Hapus 'phone' kalau form-nya tidak ada
    ]);

    $company = Company::findOrFail($id);

    $company->update([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'radius_km' => $request->radius_km,
        'time_in' => $request->time_in,
        'time_out' => $request->time_out,
    ]);

    return redirect()->route('company.show', $company->id)->with('success', 'Company updated successfully');
}






}
