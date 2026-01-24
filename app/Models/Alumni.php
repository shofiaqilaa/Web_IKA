<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'no_kta',
        'nama_lengkap',
        'email',
        'password',
        'tahun_lulus',
        'angkatan',
        'jurusan',
        'metode_pengiriman_kta',
        'alamat',
        'jumlah_kta',
        
        'pas_foto',
        'bukti_transfer_kta',
        'bukti_transfer_donasi',

        'bersedia_donasi',
        'jumlah_donasi',

        'no_wa',
    ];

    protected $hidden = [
        'password'
    ];
}
