<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $table = 'loker'; // pastikan nama tabel di database memang 'loker'
    protected $primaryKey = 'id_loker';
    public $timestamps = false; // aktifkan kalau tabel punya created_at & updated_at

    protected $fillable = [
        'judul_loker',
        'deskripsi_loker',
        'id_perusahaan',
        'gambar',
    ];

    /**
     * Relasi ke tabel master_perusahaan
     */
    public function perusahaan()
    {
        return $this->belongsTo(MasterPerusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }
}
