<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAdmin = User::where('role', 'admin')->count();
        $totalNews = 42; // sementara hardcode, bisa ganti jika ada tabel News
        $totalReports = 1201; // bisa ganti jika ada tabel Report
        $onlineUsers = User::where('is_online', true)->count();

        return view('pages.dashboard', compact('totalAdmin', 'totalNews', 'totalReports', 'onlineUsers'));
    }
}
