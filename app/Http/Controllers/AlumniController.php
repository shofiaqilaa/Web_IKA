<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

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
        'nama_alumni' => 'required|string|max:255',
        'nim' => 'required|string|max:20|unique:alumni,nim',
        'tahun_lulus' => 'required|numeric',
        'jurusan_alumni' => 'required|string|max:100',
        'prodi_alumni' => 'required|string|max:100',
    ]);

    $alumni = Alumni::create($validated);
    return response()->json(['success' => true, 'data' => $alumni]);
}

    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('alumni.edit', compact('alumni'));
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::findOrFail($id);

        $request->validate([
            'nama_alumni' => 'required|string|max:100',
            'NIM' => 'required|string|max:20|unique:alumni,NIM,' . $id,
            'tahun_lulus' => 'required|digits:4',
            'jurusan_alumni' => 'required|string|max:100',
            'prodi_alumni' => 'required|string|max:100',
        ]);

        $alumni->update($request->all());
        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Alumni::destroy($id);
        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil dihapus!');
    }
}
