<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'master_perusahaan';
    protected $primaryKey = 'id_perusahaan';
    public $timestamps = false;

    protected $fillable = [
        'nama_perusahaan',
        'alamat_perusahaan',
        'kontak_perusahaan',
        'deskripsi_perusahaan',
    ];

    public function loker()
    {
        return $this->hasMany(Loker::class, 'id_perusahaan', 'id_perusahaan');
    }
}
