<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PendudukController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $keyword = $request->query('search');

        $penduduk = Penduduk::when($keyword, function ($q) use ($keyword) {
                $q->where(function ($q2) use ($keyword) {
                    $q2->where('nik', 'like', "%{$keyword}%")
                       ->orWhere('nama', 'like', "%{$keyword}%")
                       ->orWhere('desa', 'like', "%{$keyword}%")
                       ->orWhere('alamat_lengkap', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $keyword]);

        return view('penduduk.index', compact('penduduk', 'keyword'));
    }

    public function create()
    {
        $this->authorize('create penduduk');
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create penduduk');
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:penduduk,nik',
            'no_kk' => 'nullable|string|size:16',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'dukuh' => 'nullable|string|max:100',
            'desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'nama_ayah' => 'nullable|string|max:100',
            'nama_ibu' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:15',
        ]);
        Penduduk::create($validated);
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan!');
    }

    public function show(Penduduk $penduduk)
    {
        return view('penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        $this->authorize('edit penduduk');
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $this->authorize('edit penduduk');
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:penduduk,nik,' . $penduduk->id,
            'no_kk' => 'nullable|string|size:16',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'dukuh' => 'nullable|string|max:100',
            'desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'nama_ayah' => 'nullable|string|max:100',
            'nama_ibu' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:15',
        ]);
        $penduduk->update($validated);
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui!');
    }

    public function destroy(Penduduk $penduduk)
    {
        $this->authorize('delete penduduk');
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus!');
    }
}
