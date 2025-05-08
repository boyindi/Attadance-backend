<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function checkin(Request $request)
    {
        // Validasi latitude dan longitude
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required', // Perbaiki typo
        ]);

        // Simpan data absensi baru
        $attendance = new Attendance();
        $attendance->user_id = $request->user()->id; // Pastikan pengguna terautentikasi
        $attendance->date = now()->format('Y-m-d');
        $attendance->time_in = now()->format('H:i:s');
        $attendance->latlong_in = $request->latitude . ',' . $request->longitude; // Ambil dari request
        $attendance->save();

        return response([
            'message' => 'checkin success', // Perbaiki typo
            'attendance' => $attendance
        ], 200);
    }
    // checkout
    public function checkout(Request $request)
    {
        // Validasi latitude dan longitude
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // Ambil absensi terakhir untuk pengguna yang terautentikasi
        $attendance = Attendance::where('user_id', $request->user()->id)
            ->where('date', now()->format('Y-m-d'))
            ->first();
// cek apakah absensi ada
        if (!$attendance) {
            return response([
                'message' => 'Attendance not found'
            ], 404);
        }

        // Update waktu keluar dan lokasi
        $attendance->time_out = now()->format('H:i:s');
        $attendance->latlong_out = $request->latitude . ',' . $request->longitude; // Ambil dari request
        $attendance->save();

        return response([
            'message' => 'checkout success', // Perbaiki typo
            'attendance' => $attendance
        ], 200);
    }

    // check is checkdin
    public function isCheckedin(Request $request)
    {
        // Ambil absensi terakhir untuk pengguna yang terautentikasi
        $attendance = Attendance::where('user_id', $request->user()->id)
            ->where('date', now()->format('Y-m-d'))
            ->first();
       return response([
            'is_checkedin' => $attendance ? true : false,

        ], 200);


    }

}
