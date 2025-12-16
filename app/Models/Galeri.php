<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    /**
     * Field yang boleh di–mass assignment
     */
    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'id_alumni', // ✅ WAJIB agar relasi tersimpan
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'id_alumni' => 'integer',
    ];

    /**
     * Relasi:
     * 1 Galeri dimiliki oleh 1 Alumni
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni');
    }

    /**
     * Accessor: URL lengkap gambar
     * bisa dipanggil dengan $galeri->gambar_url
     */
    public function getGambarUrlAttribute()
    {
        if (empty($this->foto)) {
            return null;
        }

        return asset('storage/' . $this->foto);
    }

    /**
     * Backward compatibility
     * jika view lama pakai $galeri->foto_url
     */
    public function getFotoUrlAttribute()
    {
        return $this->getGambarUrlAttribute();
    }
}
