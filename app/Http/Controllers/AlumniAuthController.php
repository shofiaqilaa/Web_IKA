<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\AlumniRegisterMail;
use Illuminate\Support\Facades\Mail;


class AlumniAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:alumni,email',
            'tahun_lulus' => 'required',
            'jurusan' => 'required',
            'no_wa' => 'required',
            'metode_pengiriman_kta' => 'required|in:diantar,diambil',
            'jumlah_kta' => 'required|integer|min:1',
            'bersedia_donasi' => 'required'
        ]);

        $bersediaDonasi = filter_var(
            $request->bersedia_donasi,
            FILTER_VALIDATE_BOOLEAN
        );

        $alamat = null;
        if ($request->metode_pengiriman_kta === 'diantar') {
            $request->validate(['alamat' => 'required']);
            $alamat = $request->alamat;
        }

        $jumlahDonasi = null;
        if ($bersediaDonasi) {
            $request->validate([
                'jumlah_donasi' => 'required|numeric|min:1000'
            ]);
            $jumlahDonasi = $request->jumlah_donasi;
        }

        // ===== GENERATE NO KTA BARU =====

// mapping jurusan ke kode
$kodeJurusan = match ($request->jurusan) {
    'Administrasi Bisnis' => '01',
    'Akuntansi' => '02',
    'Teknik Elektro' => '03',
    'Teknik Mesin' => '04',
    'Teknik Sipil' => '05',
    default => '00'
};

// tahun lulus
$tahun = $request->tahun_lulus;

// ambil data terakhir berdasarkan tahun & jurusan
$last = Alumni::where('tahun_lulus', $tahun)
    ->where('jurusan', $request->jurusan)
    ->orderBy('no_kta', 'desc')
    ->first();

// tentukan urutan
if ($last) {
    $lastNumber = (int) substr($last->no_kta, -3);
    $urutan = $lastNumber + 1;
} else {
    $urutan = 1;
}

// format 001, 002, dst
$urutanFormatted = str_pad($urutan, 3, '0', STR_PAD_LEFT);

// gabungkan jadi No KTA
$noKta = $tahun . $kodeJurusan . $urutanFormatted;

// ===== END NO KTA =====


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
    'bersedia_donasi' => $bersediaDonasi,
    'jumlah_donasi' => $jumlahDonasi,
    'no_wa' => $request->no_wa,
    'alamat' => $alamat
]);

// KIRIM EMAIL KE ALUMNI
Mail::to($request->email)->send(
    new AlumniRegisterMail(
        $noKta,
        $request->email,
        $plainPassword
    )
);


        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data' => [
                'no_kta' => $noKta,
                'password' => $plainPassword
            ]
        ], 201);
    }
        public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'no_kta' => 'required',
            'password' => 'required'
        ]);

        // 2. Cari alumni berdasarkan No KTA
        $noKta = trim($request->no_kta);
        $password = trim($request->password);

        $alumni = Alumni::where('no_kta', $noKta)->first();


        // 3. Jika alumni tidak ditemukan
        if (!$alumni) {
            return response()->json([
                'success' => false,
                'message' => 'No KTA tidak ditemukan'
            ], 404);
        }

        // 4. Cek password
        if (!Hash::check($password, $alumni->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah'
            ], 401);
        }

        // 5. Login berhasil
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'id' => $alumni->id,
                'no_kta' => $alumni->no_kta,
                'nama_lengkap' => $alumni->nama_lengkap,
                'email' => $alumni->email,
                'jurusan' => $alumni->jurusan,
                'tahun_lulus' => $alumni->tahun_lulus
            ]
        ], 200);
    }
}
