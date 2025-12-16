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
    $alumnis = \App\Models\Alumni::all(); // ← kirim data alumni
    return view('galeri.create', compact('alumnis'));
}

public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'foto' => 'image|mimes:jpg,png,jpeg|max:2048',
        'id_alumni' => 'required|exists:alumnis,id'  // ← validasi id_alumni
    ]);

    $path = null;
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('galeri', 'public');
    }

    Galeri::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'foto' => $path,
        'id_alumni' => $request->id_alumni  // ← simpan id_alumni
    ]);

    return redirect('/galeri')->with('success', 'Galeri berhasil ditambahkan');
}

public function edit($id)
{
    $galeri = Galeri::findOrFail($id);
    $alumnis = \App\Models\Alumni::all(); // ← kirim data alumni
    return view('galeri.edit', compact('galeri', 'alumnis'));
}

public function update(Request $request, $id)
{
    $galeri = Galeri::findOrFail($id);

    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'foto' => 'image|mimes:jpg,png,jpeg|max:2048',
        'id_alumni' => 'required|exists:alumnis,id'
    ]);

    $path = $galeri->foto;

    if ($request->hasFile('foto')) {
        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }
        $path = $request->file('foto')->store('galeri', 'public');
    }

    $galeri->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'foto' => $path,
        'id_alumni' => $request->id_alumni  // ← update id_alumni
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
    }

    /*
|--------------------------------------------------------------------------
| BAGIAN UNTUK API (FLUTTER)
|--------------------------------------------------------------------------
*/

// GET semua galeri
public function apiIndex()
{
    $galeri = Galeri::with('alumni')->get(); // ← eager load relasi alumni
    
    // Transform data biar include nama alumni & URL foto lengkap
    $data = $galeri->map(function($item) {
        return [
            'id' => $item->id,
            'judul' => $item->judul,
            'deskripsi' => $item->deskripsi,
            'foto' => $item->foto ? asset('storage/' . $item->foto) : null,
            'id_alumni' => $item->id_alumni,
            'nama_alumni' => $item->alumni ? $item->alumni->nama : null, // ← nama alumni
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });

    return response()->json([
        'status' => true,
        'data' => $data
    ]);
}

// POST tambah galeri dari Flutter
public function apiStore(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'id_alumni' => 'required|exists:alumnis,id', // ← validasi id_alumni
        'foto' => 'nullable|image'
    ]);

    $path = null;

    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('galeri', 'public');
    }

    $data = Galeri::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'id_alumni' => $request->id_alumni, // ← simpan id_alumni
        'foto' => $path
    ]);

    // Load relasi alumni
    $data->load('alumni');

    return response()->json([
        'status' => true,
        'message' => 'Galeri berhasil ditambahkan',
        'data' => [
            'id' => $data->id,
            'judul' => $data->judul,
            'deskripsi' => $data->deskripsi,
            'foto' => $data->foto ? asset('storage/' . $data->foto) : null,
            'id_alumni' => $data->id_alumni,
            'nama_alumni' => $data->alumni ? $data->alumni->nama : null,
            'created_at' => $data->created_at,
            'updated_at' => $data->updated_at,
        ]
    ]);
}

// GET detail galeri
public function apiShow($id)
{
    $data = Galeri::with('alumni')->find($id); // ← load relasi alumni

    if (!$data) {
        return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
    }

    return response()->json([
        'status' => true, 
        'data' => [
            'id' => $data->id,
            'judul' => $data->judul,
            'deskripsi' => $data->deskripsi,
            'foto' => $data->foto ? asset('storage/' . $data->foto) : null,
            'id_alumni' => $data->id_alumni,
            'nama_alumni' => $data->alumni ? $data->alumni->nama : null,
            'created_at' => $data->created_at,
            'updated_at' => $data->updated_at,
        ]
    ]);
}

// UPDATE galeri API
public function apiUpdate(Request $request, $id)
{
    $galeri = Galeri::find($id);

    if (!$galeri) {
        return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
    }

    $request->validate([
        'id_alumni' => 'nullable|exists:alumnis,id', // ← validasi id_alumni
        'foto' => 'nullable|image'
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
        'judul' => $request->judul ?? $galeri->judul,
        'deskripsi' => $request->deskripsi ?? $galeri->deskripsi,
        'id_alumni' => $request->id_alumni ?? $galeri->id_alumni, // ← update id_alumni
        'foto' => $path
    ]);

    // Load relasi alumni
    $galeri->load('alumni');

    return response()->json([
        'status' => true,
        'message' => 'Galeri berhasil diperbarui',
        'data' => [
            'id' => $galeri->id,
            'judul' => $galeri->judul,
            'deskripsi' => $galeri->deskripsi,
            'foto' => $galeri->foto ? asset('storage/' . $galeri->foto) : null,
            'id_alumni' => $galeri->id_alumni,
            'nama_alumni' => $galeri->alumni ? $galeri->alumni->nama : null,
            'created_at' => $galeri->created_at,
            'updated_at' => $galeri->updated_at,
        ]
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