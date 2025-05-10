<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    // Menampilkan daftar permission dengan filter nama user (opsional)
    public function index(Request $request)
    {
        $permissions = Permission::with('user')
            ->when($request->input('name'), function($query, $name) {
                // Filter berdasarkan nama user
                $query->whereHas('user', function($q) use ($name) {
                    $q->where('name', 'like', "%$name%");
                });
            })
            ->orderBy('id', 'desc') // Urut dari data terbaru
            ->paginate(10); // Tampilkan 10 data per halaman

        return view('pages.permission.index', compact('permissions')); // Kirim ke view
    }

    // Menampilkan detail satu permission
    public function show($id)
    {
        $permission = Permission::with('user')->find($id); // Ambil permission dan relasi user
        return view('pages.permission.show', compact('permission')); // Kirim ke view
    }

    // Menampilkan form edit permission
    public function edit($id)
    {
        $permission = Permission::find($id); // Ambil data berdasarkan ID
        return view('pages.permission.edit', compact('permission')); // Kirim ke form edit
    }

    // Memproses update status approval permission
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id); // Pastikan permission ada

        // Validasi input apakah boolean (true/false)
        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        // Update status persetujuan
        $permission->is_approved = $request->is_approved;
        $permission->save(); // Simpan perubahan

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('permission.index')
        ->with('success', 'Permission updated successfully');
    }
}
