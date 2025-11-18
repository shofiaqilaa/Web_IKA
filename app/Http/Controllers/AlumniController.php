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
    $request->validate([
        'nama_lengkap' => 'required|string',
        'angkatan'     => 'required|integer',
        'jurusan'      => 'required|string',
        'no_wa'        => 'required|string',
        'alamat'       => 'required|string',
    ]);

    Alumni::create($request->all());

    return redirect()->route('alumni.index')->with('success', 'Data berhasil ditambahkan');
}


    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('alumni.edit', compact('alumni'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_lengkap' => 'required|string',
        'angkatan'     => 'required|integer',
        'jurusan'      => 'required|string',
        'no_wa'        => 'required|string',
        'alamat'       => 'required|string',
    ]);

    $alumni = Alumni::findOrFail($id);

    $alumni->update([
        'nama_lengkap' => $request->nama_lengkap,
        'angkatan'     => $request->angkatan,
        'jurusan'      => $request->jurusan,
        'no_wa'        => $request->no_wa,
        'alamat'       => $request->alamat,
    ]);

    return redirect()->route('alumni.index')->with('success', 'Data berhasil diperbarui');
}


    public function destroy($id)
    {
        Alumni::destroy($id);
        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil dihapus!');
    }
}
