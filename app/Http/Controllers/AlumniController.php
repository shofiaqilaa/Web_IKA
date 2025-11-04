<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::all();
        return view('alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('alumni.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alumni'   => 'required|string|max:255',
            'nomor_kta'     => 'required|string|max:20|unique:alumni,nomor_kta',
            'tahun_lulus'   => 'required|numeric',
            'jurusan_alumni'=> 'required|string|max:100',
            'prodi_alumni'  => 'required|string|max:100',
            'username'      => 'required|string|max:100|unique:alumni,username',
            'password'      => 'required|string|min:6'
        ]);

        // Simpan ke database (password di-hash)
        $validated['password'] = Hash::make($validated['password']);
        $alumni = Alumni::create($validated);

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('alumni.edit', compact('alumni'));
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);

        $validated = $request->validate([
            'nama_alumni'   => 'required|string|max:255',
            'nomor_kta'     => 'required|string|max:20|unique:alumni,nomor_kta,' . $id,
            'tahun_lulus'   => 'required|numeric',
            'jurusan_alumni'=> 'required|string|max:100',
            'prodi_alumni'  => 'required|string|max:100',
            'username'      => 'required|string|max:100|unique:alumni,username,' . $id,
            'password'      => 'nullable|string|min:6' // boleh kosong saat update
        ]);

        // Kalau user isi password baru → hash
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // biar password lama tidak dihapus
        }

        $alumni->update($validated);

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Alumni::destroy($id);
        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil dihapus!');
    }
}
