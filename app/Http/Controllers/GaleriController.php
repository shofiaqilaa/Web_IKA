<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | BAGIAN UNTUK WEB (BLADE)
    |--------------------------------------------------------------------------
    */

    // Tampilkan semua galeri
    public function index()
    {
        $galeri = Galeri::all();
        return view('galeri.index', compact('galeri'));
    }

    // Form tambah galeri
    public function create()
    {
        return view('galeri.create');
    }

    // Simpan galeri dari web
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('galeri', 'public');
        }

        Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $path
        ]);

        return redirect('/galeri')->with('success', 'Galeri berhasil ditambahkan');
    }

    // Form edit
    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.edit', compact('galeri'));
    }

    // Update dari web
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $path = $galeri->foto;

        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }

            $path = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $path
        ]);

        return redirect('/galeri')->with('success', 'Galeri berhasil diperbarui');
    }

    // Hapus data web
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect('/galeri')->with('success', 'Galeri berhasil dihapus');
    }



    /*
    |--------------------------------------------------------------------------
    | BAGIAN UNTUK API (FLUTTER)
    |--------------------------------------------------------------------------
    */

    // GET semua galeri
    public function apiIndex()
    {
        return response()->json([
            'status' => true,
            'data'   => Galeri::all()
        ]);
    }

    // POST tambah galeri dari Flutter
    public function apiStore(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image'
        ]);

        $path = null;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('galeri', 'public');
        }

        $data = Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $path
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Galeri berhasil ditambahkan',
            'data' => $data
        ]);
    }

    // GET detail galeri
    public function apiShow($id)
    {
        $data = Galeri::find($id);

        if (!$data) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['status' => true, 'data' => $data]);
    }

    // UPDATE galeri API
    public function apiUpdate(Request $request, $id)
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $path = $galeri->foto;

        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }

            $path = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update([
            'judul' => $request->judul ?? $galeri->judul,
            'deskripsi' => $request->deskripsi ?? $galeri->deskripsi,
            'foto' => $path
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Galeri berhasil diperbarui',
            'data' => $galeri
        ]);
    }

    // DELETE dari Flutter
    public function apiDelete($id)
    {
        $galeri = Galeri::find($id);

        if (!$galeri) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return response()->json(['status' => true, 'message' => 'Galeri berhasil dihapus']);
    }
}
