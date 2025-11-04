<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    // Tetap gunakan tabel master_perusahaan
    protected $table = 'master_perusahaan';
    protected $primaryKey = 'id_perusahaan';
    public $timestamps = false;

    protected $fillable = [
        'nama_perusahaan',
        'alamat_perusahaan',
        'kontak_perusahaan',
        'deskripsi_perusahaan',
    ];
}
