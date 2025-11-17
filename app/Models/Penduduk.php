<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';

    protected $fillable = [
        'nik',
        'no_kk',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'rt',
        'rw',
        'dukuh',
        'desa',
        'kecamatan',
        'alamat_lengkap',
        'status_perkawinan',
        'nama_ayah',
        'nama_ibu',
        'no_hp',
    ];
}
