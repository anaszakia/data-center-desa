@extends('layouts.app')
@section('title', 'Import Data Penduduk')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Import Data Penduduk</h1>
            <p class="text-sm text-gray-600 mt-1">Upload file Excel untuk import data penduduk secara masal</p>
        </div>
        <a href="{{ route('penduduk.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Panduan Import</h2>
            <ol class="list-decimal list-inside space-y-2 text-sm text-gray-600">
                <li>Download template Excel terlebih dahulu</li>
                <li>Isi data penduduk sesuai format pada template</li>
                <li>Upload file Excel yang sudah diisi</li>
                <li>Pastikan format tanggal: YYYY-MM-DD (contoh: 1990-01-15)</li>
                <li>Jenis Kelamin: L atau P</li>
                <li>Status Perkawinan: Belum Kawin, Kawin, Cerai Hidup, atau Cerai Mati</li>
            </ol>
        </div>

        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-600 mt-0.5 mr-3"></i>
                <div>
                    <p class="text-sm text-blue-800 font-medium">Download Template</p>
                    <p class="text-sm text-blue-700 mt-1">Gunakan template Excel untuk memastikan format data sesuai</p>
                    <a href="{{ asset('template_penduduk.xlsx') }}" class="inline-flex items-center mt-2 px-3 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                        <i class="fas fa-download mr-2"></i>Download Template Excel
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ route('penduduk.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        File Excel <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="file" accept=".xlsx,.xls" required
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 p-2">
                    @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-upload mr-2"></i>Upload & Import
                    </button>
                    <a href="{{ route('penduduk.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
