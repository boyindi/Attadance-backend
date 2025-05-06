<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Menampilkan semua data perusahaan
    public function index()
    {
        $companies = Company::all(); // Atau gunakan paginate(10) jika ingin pagination
        return response()->json($companies, 200);
    }

    // Menampilkan satu data perusahaan berdasarkan ID
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return response()->json($company, 200);
    }
}
