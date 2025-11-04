<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\MasterPerusahaan;
use Illuminate\Http\Request;

class LokerController extends Controller
{
    public function index()
    {
        $loker = Loker::with('perusahaan')->get();
        return view('loker.index', compact('loker'));
    }

    public function create()
    {
        $perusahaan = MasterPerusahaan::all();
        return view('loker.create', compact('perusahaan'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'judul_loker' => 'required|string|max:255',
        'deskripsi_loker' => 'required|string',
        // perhatikan ini diubah
        'id_perusahaan' => 'required|exists:master_perusahaan,id_perusahaan',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/loker'), $filename);
        $validated['gambar'] = 'uploads/loker/' . $filename;
    }

    Loker::create($validated);

    return redirect()->route('loker.index')->with('success', 'Lowongan berhasil ditambahkan!');
}

    public function edit($id)
    {
        $loker = Loker::findOrFail($id);
        $perusahaan = MasterPerusahaan::all();
        return view('loker.edit', compact('loker', 'perusahaan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul_loker' => 'required|string|max:255',
            'deskripsi_loker' => 'required|string',
            'id_perusahaan' => 'required|exists:master_perusahaan,id_perusahaan'
        ]);

        $loker = Loker::findOrFail($id);
        $loker->update($validated);

        return redirect()->route('loker.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Loker::destroy($id);
        return redirect()->route('loker.index')->with('success', 'Lowongan berhasil dihapus!');
    }
}
