<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    // Table 'alumni' does not have created_at/updated_at columns,
    // disable automatic timestamps to avoid SQL errors.
    public $timestamps = false;

    protected $table = 'alumni';

    protected $fillable = [
    'nama_lengkap',
    'angkatan',
    'tahun_lulus',
    'alamat',
    'no_wa',
    'jurusan',
    'metode_pengiriman_kta',
    'jumlah_kta',
    'pas_foto',
    'bukti_transfer_kta',
    'bersedia_donasi',
    'jumlah_donasi',
    'bukti_transfer_donasi',
    ];
}
