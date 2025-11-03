<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\Hash;

class AlumniAuthController extends Controller
{
    // Registrasi alumni baru
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:alumni',
            'password' => 'required|min:6',
            'nama_alumni' => 'required',
            'nim' => 'required',
            'tahun_lulus' => 'required',
            'jurusan_alumni' => 'required',
            'prodi_alumni' => 'required'
        ]);

        $alumni = Alumni::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash password
            'nama_alumni' => $request->nama_alumni,
            'nim' => $request->nim,
            'tahun_lulus' => $request->tahun_lulus,
            'jurusan_alumni' => $request->jurusan_alumni,
            'prodi_alumni' => $request->prodi_alumni
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil',
            'data' => $alumni
        ], 201);
    }

    // Login alumni
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $alumni = Alumni::where('username', $request->username)->first();

        if (!$alumni || !Hash::check($request->password, $alumni->password)) {
            return response()->json([
                'message' => 'Username atau password salah'
            ], 401);
        }

        return response()->json([
            'message' => 'Login berhasil',
            'data' => $alumni
        ]);
    }
}
