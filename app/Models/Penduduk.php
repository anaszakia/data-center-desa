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
        'status',
        'agama',
        'pendidikan_terakhir',
        'pekerjaan',
        'status_dalam_keluarga',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }
}
