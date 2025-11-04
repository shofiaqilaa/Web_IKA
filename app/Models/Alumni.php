<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'username',
        'password',
        'nama_alumni',
        'nomor_kta',
        'tahun_lulus',
        'jurusan_alumni',
        'prodi_alumni'
    ];

    public $timestamps = false; 
}

