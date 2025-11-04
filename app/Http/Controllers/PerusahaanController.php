<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::all();
        return view('perusahaan.index', compact('perusahaan'));
    }

    public function create()
    {
        return view('perusahaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'kontak_perusahaan' => 'required',
            'deskripsi_perusahaan' => 'required',
        ]);

        Perusahaan::create($request->all());
        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->update($request->all());
        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();
        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil dihapus.');
    }
}
