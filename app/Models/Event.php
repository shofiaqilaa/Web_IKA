<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_event',
        'deskripsi_event',
        'tanggal_event',
        'gambar_event',
        'kategori',
        'tujuan_kegiatan',
    ];

    // Append derived URL for API responses
    protected $appends = [
        'gambar_url',
    ];

    public function getGambarUrlAttribute()
    {
        if ($this->gambar_event) {
            return url('storage/' . $this->gambar_event);
        }
        return null;
    }
}
