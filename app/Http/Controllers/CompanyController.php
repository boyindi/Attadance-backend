<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    // Menampilkan detail perusahaan berdasarkan ID
    public function show($id)
    {
        $company = Company::findOrFail($id); // Ambil data company atau gagal jika tidak ditemukan
        return view('pages.company.show', compact('company')); // Tampilkan ke view
    }

    // Menampilkan form edit data perusahaan
    public function edit($id)
    {
        $company = Company::findOrFail($id); // Ambil data berdasarkan ID
        return view('pages.company.edit', compact('company')); // Tampilkan form edit
    }

    // Memproses update data perusahaan
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius_km' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);

        // Ambil data perusahaan berdasarkan ID
        $company = Company::findOrFail($id);

        // Update data perusahaan
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

        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect()->route('company.show', $company->id)
                         ->with('success', 'Company updated successfully');
    }
}
