<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri_usaha';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'id_alumni',
    ];

    protected $casts = [
        'id_alumni' => 'integer',
    ];

    // Relasi: setiap galeri dimiliki oleh 1 alumni
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni');
    }

    // Accessor otomatis untuk memberikan URL gambar lengkap
    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) {
            return null;
        }

        return asset('storage/' . $this->gambar);
    }
}
