<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    public function index()
{
    $admins = \App\Models\Admin::all();
    return view('admin.manage.index', compact('admins'));
}

    public function create()
    {
        return view('admin.manage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admins',
            'password' => 'required|min=4'
        ]);

        Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.manage')->with('success', 'Admin berhasil ditambahkan!');
    }
}
