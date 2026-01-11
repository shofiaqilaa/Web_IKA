<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama_lengkap' => 'required',
            'angkatan_kuliah' => 'required',
            'no_wa' => 'required',
            'jurusan' => 'required',
            'jumlah_pembelian' => 'required',
            'foto_profil' => 'required|image',
            'bukti_transfer_kta' => 'required|image',
        ]);

        // Simpan File
        $foto = $request->file('foto_profil')->store('foto', 'public');
        $bukti = $request->file('bukti_transfer_kta')->store('bukti', 'public');

        // Simpan Database
        $alumni = \App\Models\Alumni::create([
            'nama_lengkap' => $request->nama_lengkap,
            'angkatan_kuliah' => $request->angkatan_kuliah,
            'no_wa' => $request->no_wa,
            'jurusan' => $request->jurusan,
            'jumlah_pembelian' => $request->jumlah_pembelian,
            'foto_profil' => $foto,
            'bukti_transfer_kta' => $bukti,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data alumni berhasil disimpan',
            'data' => $alumni
        ]);
    }
}


