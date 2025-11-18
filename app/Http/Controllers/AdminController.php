<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:admins,username',
            'password' => 'required|string|min:6',
        ]);

        Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.create')->with('success', 'Admin baru berhasil ditambahkan!');
    }
}
