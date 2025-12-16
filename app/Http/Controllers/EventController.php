<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('event.index', compact('events'));
    }

    public function apiIndex()
    {
        $events = Event::all();

        // Ensure gambar_url and kategori are present in the API response
        $events->map(function ($item) {
            $item->gambar_url = $item->gambar_event ? url('storage/' . $item->gambar_event) : null;
            $item->kategori = $item->kategori ?? null;
            return $item;
        });

        return response()->json($events);
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_event' => 'required',
            'deskripsi_event' => 'required',
            'tanggal_event' => 'required|date',
            'gambar_event' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori' => 'required|in:berita,beasiswa,donasi',
            'tujuan_kegiatan' => 'nullable|string',
        ]);

        $path = null;

        if ($request->hasFile('gambar_event')) {
            $path = $request->file('gambar_event')->store('event', 'public');
        }

        Event::create([
            'judul_event' => $request->judul_event,
            'deskripsi_event' => $request->deskripsi_event,
            'tanggal_event' => $request->tanggal_event,
            'gambar_event' => $path,
            'kategori' => $request->kategori,
            'tujuan_kegiatan' => $request->tujuan_kegiatan,
        ]);

        return redirect()->route('event.index')->with('success', 'Event berhasil ditambahkan');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_event' => 'required',
            'deskripsi_event' => 'required',
            'tanggal_event' => 'required|date',
            'gambar_event' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori' => 'required|in:berita,beasiswa,donasi',
            'tujuan_kegiatan' => 'nullable|string',
        ]);

        $event = Event::findOrFail($id);

        // Upload gambar baru
        if ($request->hasFile('gambar_event')) {

            // Hapus gambar lama
            if ($event->gambar_event && file_exists(storage_path('app/public/'.$event->gambar_event))) {
                unlink(storage_path('app/public/'.$event->gambar_event));
            }

            $path = $request->file('gambar_event')->store('event', 'public');
            $event->gambar_event = $path;
        }

        $event->judul_event = $request->judul_event;
        $event->deskripsi_event = $request->deskripsi_event;
        $event->tanggal_event = $request->tanggal_event;
        $event->kategori = $request->kategori;
        $event->tujuan_kegiatan = $request->tujuan_kegiatan;

        $event->save();

        return redirect()->route('event.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->gambar_event && file_exists(storage_path('app/public/'.$event->gambar_event))) {
            unlink(storage_path('app/public/'.$event->gambar_event));
        }

        $event->delete();

        return redirect()->route('event.index')->with('success', 'Event berhasil dihapus!');
    }
}
