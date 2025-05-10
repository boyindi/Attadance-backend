<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    // Menyimpan data permission baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'date' => 'required',
            'reason' => 'required',
        ]);

        // Buat instance permission baru
        $permission = new Permission();
        $permission->user_id = $request->user()->id;
        $permission->date_permission = $request->date;
        $permission->reason = $request->reason;
        $permission->is_approved = 0; // default belum disetujui

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/permissions', $image->hashName());
            $permission->image = $image->hashName();
        }

        // Simpan data ke database
        $permission->save();

        // Kembalikan respon sukses
        return response()->json([
            'message' => 'Permission created successfully',
        ], 201);
    }
}
