@extends('layouts.app')
@section('title', 'Detail Penduduk')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $penduduk->nama }}</h1>
            <p class="text-sm text-gray-600 mt-1">Detail data penduduk desa</p>
        </div>
        <div class="flex gap-2">
            @can('edit penduduk')
            <a href="{{ route('penduduk.edit', $penduduk) }}" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            @endcan
            <a href="{{ route('penduduk.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="space-y-8">
            <div>
                <h3 class="text-base font-bold text-gray-800 mb-2">Data Diri</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">NIK</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->nik }}</p></div>
                    <div>
                        <label class="text-xs font-semibold text-gray-600 uppercase">Status Kependudukan</label>
                        <p class="text-sm mt-1">
                            @if($penduduk->status)
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Aktif</span>
                            @else
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-800">Tidak Aktif</span>
                            @endif
                        </p>
                    </div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">No KK</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->no_kk ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Nama</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->nama }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Jenis Kelamin</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Tempat Lahir</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->tempat_lahir }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Tanggal Lahir</label><p class="text-sm text-gray-900 mt-1">{{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d-m-Y') }}</p></div>
                </div>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-800 mb-2">Alamat</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">RT/RW</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->rt ?? '-' }}/{{ $penduduk->rw ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Dukuh</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->dukuh ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Desa</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->desa }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Kecamatan</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->kecamatan }}</p></div>
                    <div class="col-span-2"><label class="text-xs font-semibold text-gray-600 uppercase">Alamat Lengkap</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->alamat_lengkap }}</p></div>
                </div>
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-800 mb-2">Data Pendukung</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Status Perkawinan</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->status_perkawinan }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Nama Ayah</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->nama_ayah ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Nama Ibu</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->nama_ibu ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">No HP</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->no_hp ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Agama</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->agama ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Pendidikan Terakhir</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->pendidikan_terakhir ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Pekerjaan</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->pekerjaan ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Status Dalam Keluarga</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->status_dalam_keluarga ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Dibuat</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->created_at?->format('d M Y, H:i') ?? '-' }}</p></div>
                    <div><label class="text-xs font-semibold text-gray-600 uppercase">Diubah</label><p class="text-sm text-gray-900 mt-1">{{ $penduduk->updated_at?->format('d M Y, H:i') ?? '-' }}</p></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
