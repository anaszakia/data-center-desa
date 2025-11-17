@extends('layouts.app')
@section('title', 'Data Penduduk Desa')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Penduduk</h1>
            <p class="text-sm text-gray-600 mt-1">Manajemen data penduduk desa</p>
        </div>
        @can('create penduduk')
        <a href="{{ route('penduduk.create') }}" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors">
            <i class="fas fa-plus mr-2"></i>Tambah Penduduk
        </a>
        @endcan
    </div>
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <form method="GET" action="{{ route('penduduk.index') }}" class="flex gap-3">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari NIK, Nama, Desa, atau Alamat..."
                           class="w-full px-4 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
                </div>
                <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm rounded-lg hover:bg-gray-800 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('search'))
                <a href="{{ route('penduduk.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-times"></i>
                </a>
                @endif
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">NIK</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">JK</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tempat/Tgl Lahir</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Alamat</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Desa</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kecamatan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($penduduk as $p)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3">{{ $p->nik }}</td>
                        <td class="px-4 py-3">{{ $p->nama }}</td>
                        <td class="px-4 py-3">{{ $p->jenis_kelamin }}</td>
                        <td class="px-4 py-3">{{ $p->tempat_lahir }}, {{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td class="px-4 py-3">{{ $p->alamat_lengkap }}</td>
                        <td class="px-4 py-3">{{ $p->desa }}</td>
                        <td class="px-4 py-3">{{ $p->kecamatan }}</td>
                        <td class="px-4 py-3">{{ $p->status_perkawinan }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('penduduk.show', $p) }}" class="p-1.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded transition-colors">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                @can('edit penduduk')
                                <a href="{{ route('penduduk.edit', $p) }}" class="p-1.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded transition-colors">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                @endcan
                                @can('delete penduduk')
                                <form action="{{ route('penduduk.destroy', $p) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="p-1.5 text-red-600 hover:text-red-700 hover:bg-red-50 rounded transition-colors">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-8 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mb-3">
                                    <i class="fas fa-users text-gray-400 text-xl"></i>
                                </div>
                                <p class="text-gray-600 font-medium">Data penduduk tidak ditemukan</p>
                                <p class="text-gray-500 text-sm mt-1">Mulai dengan menambah data penduduk</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($penduduk->hasPages())
        <div class="p-4 border-t border-gray-200">
            {{ $penduduk->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
