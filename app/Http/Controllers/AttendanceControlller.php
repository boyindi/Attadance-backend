<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceControlller extends Controller
{
    // Menampilkan daftar absensi, dengan opsi filter nama user
    public function index(Request $request)
    {
        $attendances = Attendance::with('user') // Relasi dengan tabel user
            ->when($request->input('name'), function ($query, $name) {
                // Filter berdasarkan nama user jika ada input 'name'
                $query->whereHas('user', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                });
            })
            ->orderBy('id', 'desc') // Urutkan dari terbaru
            ->paginate(10); // Paginasi 10 data per halaman

        return view('pages.absensi.index', compact('attendances')); // Tampilkan ke view
    }
}
