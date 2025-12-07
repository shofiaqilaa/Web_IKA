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
    'tahun_lulus',
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
