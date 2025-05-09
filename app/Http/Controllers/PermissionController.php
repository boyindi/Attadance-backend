<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //index
    public function index( Request $request)
    {
        $permissions =Permission::with('user')
        ->when(
            $request->input('name'),function($query, $name) {
                $query->whereHas('user', function($q) use ($name) {
                    $q->where('name', 'like', "%$name%");
                });

            }) ->orderBy('id', 'desc')
            ->paginate(10);
            return view('pages.permission.index',compact('permissions'));

    }

}
