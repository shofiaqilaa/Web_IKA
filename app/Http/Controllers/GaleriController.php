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
    $galeris = Galeri::with('alumni')->get(); // ← tambah with('alumni')
    return view('galeri.index', compact('galeris'));
    }

    // Form tambah galeri
    public function create()
    {
        $alumnis = \App\Models\Alumni::all();
        return view('galeri.create', compact('alumnis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048',
            'id_alumni' => 'required|exists:alumni,id'
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('galeri', 'public');
        }

        Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $path,
            'id_alumni' => $request->id_alumni
        ]);

        return redirect('/galeri')->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        $alumnis = \App\Models\Alumni::all();
        return view('galeri.edit', compact('galeri', 'alumnis'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048',
            'id_alumni' => 'required|exists:alumni,id'
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
            'id_alumni' => $request->id_alumni
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

    // GET semua galeri (API)
    public function apiIndex()
    {
        $galeri = Galeri::with('alumni')->get();

        $data = $galeri->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'deskripsi' => $item->deskripsi,
                'foto' => $item->foto ? route('image.galeri', ['filename' => basename($item->foto)]) : null,
                'id_alumni' => $item->id_alumni,
                'nama_alumni' => $item->alumni ? $item->alumni->nama : null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Data galeri berhasil diambil',
            'data' => $data,
        ], 200);
    }

    // POST tambah galeri (API)
    public function apiStore(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image',
            'id_alumni' => 'required|exists:alumni,id'
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('galeri', 'public');
        }

        $data = Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $path,
            'id_alumni' => $request->id_alumni
        ]);

        $data->load('alumni');

        return response()->json([
            'status' => true,
            'message' => 'Galeri berhasil ditambahkan',
            'data' => [
                'id' => $data->id,
                'judul' => $data->judul,
                'deskripsi' => $data->deskripsi,
                'foto' => $data->foto ? route('image.galeri', ['filename' => basename($data->foto)]) : null,
                'id_alumni' => $data->id_alumni,
                'nama_alumni' => $data->alumni ? $data->alumni->nama : null,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
            ],
        ], 201);
    }

    // GET detail galeri (API)
    public function apiShow($id)
    {
        $data = Galeri::with('alumni')->find($id);
        if (!$data) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data galeri ditemukan',
            'data' => [
                'id' => $data->id,
                'judul' => $data->judul,
                'deskripsi' => $data->deskripsi,
                'foto' => $data->foto ? route('image.galeri', ['filename' => basename($data->foto)]) : null,
                'id_alumni' => $data->id_alumni,
                'nama_alumni' => $data->alumni ? $data->alumni->nama : null,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
            ],
        ], 200);
    }

    // UPDATE galeri (API)
    public function apiUpdate(Request $request, $id)
    {
        $galeri = Galeri::find($id);
        if (!$galeri) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'judul' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image',
            'id_alumni' => 'nullable|exists:alumni,id'
        ]);

        $path = $galeri->foto;
        if ($request->hasFile('foto')) {
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $path = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update([
            'judul' => $request->judul ?? $galeri->judul,
            'deskripsi' => $request->deskripsi ?? $galeri->deskripsi,
            'foto' => $path,
            'id_alumni' => $request->id_alumni ?? $galeri->id_alumni
        ]);

        $galeri->load('alumni');

        return response()->json([
            'status' => true,
            'message' => 'Galeri berhasil diperbarui',
            'data' => [
                'id' => $galeri->id,
                'judul' => $galeri->judul,
                'deskripsi' => $galeri->deskripsi,
                'foto' => $galeri->foto ? route('image.galeri', ['filename' => basename($galeri->foto)]) : null,
                'id_alumni' => $galeri->id_alumni,
                'nama_alumni' => $galeri->alumni ? $galeri->alumni->nama : null,
                'created_at' => $galeri->created_at,
                'updated_at' => $galeri->updated_at,
            ],
        ], 200);
    }

    // DELETE galeri (API)
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
