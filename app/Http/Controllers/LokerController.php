<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\MasterPerusahaan;
use Illuminate\Http\Request;

class LokerController extends Controller
{
    /**
     * Menampilkan semua lowongan (HALAMAN ADMIN)
     */
    public function index()
    {
        $loker = Loker::with('perusahaan')->get();
        return view('loker.index', compact('loker'));
    }

    public function apiIndex()
    {
    return response()->json(
        Loker::with('perusahaan')->get()
    );
    }

    /**
     * Menampilkan form tambah loker
     */
    public function create()
    {
        $perusahaan = MasterPerusahaan::all();
        return view('loker.create', compact('perusahaan'));
    }

    /**
     * Menyimpan data loker baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_loker'       => 'required|string|max:255',
            'deskripsi_loker'   => 'required|string',
            'id_perusahaan'     => 'required|exists:master_perusahaan,id_perusahaan',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/loker'), $filename);
            $validated['gambar'] = 'uploads/loker/'.$filename;
        }

        Loker::create($validated);

        return redirect()->route('loker.index')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit loker
     */
    public function edit($id)
    {
        $loker = Loker::findOrFail($id);
        $perusahaan = MasterPerusahaan::all();

        return view('loker.edit', compact('loker', 'perusahaan'));
    }

    /**
     * Update data loker
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul_loker'       => 'required|string|max:255',
            'deskripsi_loker'   => 'required|string',
            'id_perusahaan'     => 'required|exists:master_perusahaan,id_perusahaan',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $loker = Loker::findOrFail($id);

        // jika ada gambar baru
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/loker'), $filename);
            $validated['gambar'] = 'uploads/loker/'.$filename;
        }

        $loker->update($validated);

        return redirect()->route('loker.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    /**
     * Hapus loker
     */
    public function destroy($id)
    {
        $loker = Loker::findOrFail($id);

        // hapus file gambar jika ada
        if ($loker->gambar && file_exists(public_path($loker->gambar))) {
            unlink(public_path($loker->gambar));
        }

        $loker->delete();

        return redirect()->route('loker.index')->with('success', 'Lowongan berhasil dihapus!');
    }
}
