<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\Hash;

class AlumniAuthController extends Controller
{
    // 🔹 Registrasi alumni baru
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:alumni',
            'password' => 'required|min:6',
            'nama_alumni' => 'required',
            'nomor_kta' => 'required|unique:alumni,nomor_kta',
            'tahun_lulus' => 'required',
            'jurusan_alumni' => 'required',
            'prodi_alumni' => 'required'
        ]);

        $alumni = Alumni::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // hash password biar aman
            'nama_alumni' => $request->nama_alumni,
            'nomor_kta' => $request->nomor_kta,
            'tahun_lulus' => $request->tahun_lulus,
            'jurusan_alumni' => $request->jurusan_alumni,
            'prodi_alumni' => $request->prodi_alumni
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil',
            'data' => $alumni
        ], 201);
    }

    // 🔹 Login alumni (pakai username ATAU nomor_kta)
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required', // bisa username atau nomor_kta
            'password' => 'required'
        ]);

        // cari berdasarkan username ATAU nomor_kta
        $alumni = Alumni::where('username', $request->login)
                        ->orWhere('nomor_kta', $request->login)
                        ->first();

        if (!$alumni || !Hash::check($request->password, $alumni->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Login gagal, periksa kembali username/nomor KTA dan password.'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil!',
            'data' => [
                'id' => $alumni->id,
                'nama_alumni' => $alumni->nama_alumni,
                'username' => $alumni->username,
                'nomor_kta' => $alumni->nomor_kta,
                'jurusan_alumni' => $alumni->jurusan_alumni,
                'prodi_alumni' => $alumni->prodi_alumni
            ]
        ]);
    }
}
