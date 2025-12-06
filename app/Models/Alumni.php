<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'nama_lengkap',
        'angkatan_kuliah',
        'no_wa',
        'jurusan',

        // KTA
        'metode_pengiriman',
        'alamat_pengiriman',
        'jumlah_pembelian',
        'foto_profil',              // file
        'bukti_transfer_kta',       // file

        // Donasi
        'bersedia_donasi',          // Ya / Tidak
        'jumlah_donasi',            // boleh null
        'bukti_transfer_donasi',    // boleh null

        // Tambahan opsional
        'status_verifikasi',        // default: pending
    ];
}
