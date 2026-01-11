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
    'jumlah_kta',
    'bersedia_donasi',
    'jumlah_donasi',
    'no_wa',
    'alamat'
];


    protected $hidden = [
        'password'
    ];
}
