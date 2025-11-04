<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GaleriUsaha;
use App\Models\Alumni;

class GaleriUsahaController extends Controller
{
    public function index()
    {
        $galeris = GaleriUsaha::with('alumni')->get();
        return view('galeri.index', compact('galeris'));
    }

    public function create()
    {
        $alumnis = Alumni::all();
        return view('galeri.create', compact('alumnis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'id_alumni' => 'required|exists:alumni,id',
        ]);

        $path = $request->file('gambar')->store('uploads/galeri', 'public');

        GaleriUsaha::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
            'id_alumni' => $request->id_alumni,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $galeri = GaleriUsaha::findOrFail($id);
        $alumnis = Alumni::all();
        return view('galeri.edit', compact('galeri', 'alumnis'));
    }

    public function update(Request $request, $id)
    {
        $galeri = GaleriUsaha::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'id_alumni' => 'required|exists:alumni,id',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('uploads/galeri', 'public');
            $galeri->gambar = $path;
        }

        $galeri->judul = $request->judul;
        $galeri->deskripsi = $request->deskripsi;
        $galeri->id_alumni = $request->id_alumni;
        $galeri->save();

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = GaleriUsaha::findOrFail($id);
        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
