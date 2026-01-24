<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlumniRegisterMail;

class AlumniAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'email' => 'required|email',
            'tahun_lulus' => 'required|numeric',
            'jurusan' => 'required',
            'no_wa' => 'required',
            'metode_pengiriman_kta' => 'required|in:diantar,diambil',
            'alamat' => 'required_if:metode_pengiriman_kta,diantar',
            'jumlah_kta' => 'required|integer|min:1',
            'pas_foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bukti_transfer_kta' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bersedia_donasi' => 'required|in:true,false',
            'jumlah_donasi' => 'nullable|required_if:bersedia_donasi,true|numeric',
            'bukti_transfer_donasi' => 'required_if:bersedia_donasi,true|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $pasFoto = $request->file('pas_foto')->store('pas_foto', 'public');
        $buktiKta = $request->file('bukti_transfer_kta')->store('bukti_kta', 'public');

        $buktiDonasi = null;
        if ($request->hasFile('bukti_transfer_donasi')) {
            $buktiDonasi = $request->file('bukti_transfer_donasi')->store('bukti_donasi', 'public');
        }

        $bersediaDonasi = filter_var($request->bersedia_donasi, FILTER_VALIDATE_BOOLEAN);

        $kodeJurusan = match ($request->jurusan) {
            'Administrasi Bisnis' => '01',
            'Akuntansi' => '02',
            'Teknik Elektro' => '03',
            'Teknik Mesin' => '04',
            'Teknik Sipil' => '05',
            default => '00'
        };

        $last = Alumni::where('tahun_lulus', $request->tahun_lulus)
            ->where('jurusan', $request->jurusan)
            ->orderBy('no_kta', 'desc')
            ->first();

        $urutan = $last ? ((int) substr($last->no_kta, -3) + 1) : 1;
        $noKta = $request->tahun_lulus . $kodeJurusan . str_pad($urutan, 3, '0', STR_PAD_LEFT);

        $plainPassword = Str::random(8);

        Alumni::create([
            'no_kta' => $noKta,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($plainPassword),
            'tahun_lulus' => $request->tahun_lulus,
            'angkatan' => $request->tahun_lulus,
            'jurusan' => $request->jurusan,
            'metode_pengiriman_kta' => $request->metode_pengiriman_kta,
            'jumlah_kta' => $request->jumlah_kta,
            'pas_foto' => $pasFoto,
            'bukti_transfer_kta' => $buktiKta,
            'bukti_transfer_donasi' => $buktiDonasi,
            'bersedia_donasi' => $bersediaDonasi,
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        Mail::to($request->email)->send(
            new AlumniRegisterMail($noKta, $request->email, $plainPassword)
        );

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil'
        ], 200);
    }

    // ✅ LOGIN HARUS DI DALAM CLASS
    public function login(Request $request)
    {
        $request->validate([
            'no_kta' => 'required',
            'password' => 'required'
        ]);

        $alumni = Alumni::where('no_kta', $request->no_kta)->first();

        if (!$alumni || !Hash::check($request->password, $alumni->password)) {
            return response()->json([
                'success' => false,
                'message' => 'No KTA atau password salah'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'no_kta' => $alumni->no_kta,
                'nama' => $alumni->nama_lengkap,
                'email' => $alumni->email
            ]
        ], 200);
    }
}
