@extends('layouts.app')
@section('title', 'Tambah Penduduk')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Penduduk</h1>
            <p class="text-sm text-gray-600 mt-1">Form tambah data penduduk desa</p>
        </div>
        <a href="{{ route('penduduk.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form action="{{ route('penduduk.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required maxlength="16" minlength="16" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('nik')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="no_kk" class="block text-sm font-medium text-gray-700 mb-2">No KK</label>
                    <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk') }}" maxlength="16" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('no_kk')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required maxlength="100" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required maxlength="100" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('tempat_lahir')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('tanggal_lahir')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="rt" class="block text-sm font-medium text-gray-700 mb-2">RT</label>
                    <input type="text" name="rt" id="rt" value="{{ old('rt') }}" maxlength="3" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('rt')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="rw" class="block text-sm font-medium text-gray-700 mb-2">RW</label>
                    <input type="text" name="rw" id="rw" value="{{ old('rw') }}" maxlength="3" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('rw')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="dukuh" class="block text-sm font-medium text-gray-700 mb-2">Dukuh</label>
                    <input type="text" name="dukuh" id="dukuh" value="{{ old('dukuh') }}" maxlength="100" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('dukuh')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="desa" class="block text-sm font-medium text-gray-700 mb-2">Desa <span class="text-red-500">*</span></label>
                    <input type="text" name="desa" id="desa" value="{{ old('desa') }}" required maxlength="100" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('desa')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-2">Kecamatan <span class="text-red-500">*</span></label>
                    <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan') }}" required maxlength="100" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('kecamatan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="alamat_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="alamat_lengkap" id="alamat_lengkap" required rows="2" class="w-full px-4 py-2 border border-gray-200 rounded-lg">{{ old('alamat_lengkap') }}</textarea>
                    @error('alamat_lengkap')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="status_perkawinan" class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan <span class="text-red-500">*</span></label>
                    <select name="status_perkawinan" id="status_perkawinan" required class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                        <option value="">Pilih Status</option>
                        <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                        <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                    @error('status_perkawinan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah</label>
                    <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}" maxlength="100" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('nama_ayah')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu</label>
                    <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}" maxlength="100" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('nama_ibu')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" maxlength="15" class="w-full px-4 py-2 border border-gray-200 rounded-lg">
                    @error('no_hp')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="flex gap-3 pt-6 border-t border-gray-200 mt-6">
                <button type="submit" class="px-6 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors">
                    <i class="fas fa-save mr-2"></i>Simpan Data
                </button>
                <a href="{{ route('penduduk.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
