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
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string',
            'kontak_perusahaan' => 'required|string|max:100',
            'deskripsi_perusahaan' => 'required|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'lokasi' => 'nullable|string|max:255',
            'tentang_kami' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/perusahaan'), $filename);
            $validated['logo'] = 'uploads/perusahaan/'.$filename;
        }

        Perusahaan::create($validated);
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

        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string',
            'kontak_perusahaan' => 'required|string|max:100',
            'deskripsi_perusahaan' => 'required|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'lokasi' => 'nullable|string|max:255',
            'tentang_kami' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        // handle logo upload
        if ($request->hasFile('logo')) {
            // delete old logo if exists
            if ($perusahaan->logo && file_exists(public_path($perusahaan->logo))) {
                @unlink(public_path($perusahaan->logo));
            }
            $file = $request->file('logo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/perusahaan'), $filename);
            $validated['logo'] = 'uploads/perusahaan/'.$filename;
        }

        $perusahaan->update($validated);
        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();
        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil dihapus.');
    }
}
