<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Alumni extends Authenticatable
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'nama_alumni',
        'NIM',
        'tahun_lulus',
        'jurusan_alumni',
        'prodi_alumni',
    ];

    public $timestamps = false;
}
