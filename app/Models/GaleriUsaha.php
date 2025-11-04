<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriUsaha extends Model
{
    use HasFactory;

    protected $table = 'galeri_usaha';
    protected $fillable = ['judul', 'deskripsi', 'gambar', 'id_alumni'];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni');
    }
}
