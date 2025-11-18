<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PendudukController extends Controller
{
    use AuthorizesRequests;

    /**
     * Hapus massal data penduduk
     */
    public function bulkDelete(Request $request)
    {
        $this->authorize('delete penduduk');
        $ids = explode(',', $request->input('ids'));
        $deleted = Penduduk::whereIn('id', $ids)->delete();
        return redirect()->route('penduduk.index')->with('success', "Berhasil menghapus {$deleted} data penduduk.");
    }
    use AuthorizesRequests;

    /**
     * Tampilkan form upload Excel untuk import penduduk
     */
    public function importForm()
    {
        return view('penduduk.import');
    }
    use AuthorizesRequests;

    /**
     * Import data penduduk dari file Excel
     */
    public function import(Request $request)
    {
        $this->authorize('create penduduk');
        
        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            $file = $request->file('file');
            $path = $file->getRealPath();
            
            // Load file Excel menggunakan PhpSpreadsheet
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            
            // Skip header row (baris pertama)
            $header = array_shift($rows);
            
            $imported = 0;
            $errors = [];
            
            foreach ($rows as $index => $row) {
                // Skip baris kosong
                if (empty(array_filter($row))) {
                    continue;
                }
                
                try {
                    // Mapping kolom sesuai template Excel
                    $data = [
                        'nik' => $row[0] ?? null,
                        'no_kk' => $row[1] ?? null,
                        'nama' => $row[2] ?? null,
                        'jenis_kelamin' => $row[3] ?? null,
                        'tempat_lahir' => $row[4] ?? null,
                        'tanggal_lahir' => $row[5] ?? null,
                        'rt' => $row[6] ?? null,
                        'rw' => $row[7] ?? null,
                        'dukuh' => $row[8] ?? null,
                        'desa' => $row[9] ?? null,
                        'kecamatan' => $row[10] ?? null,
                        'alamat_lengkap' => $row[11] ?? null,
                        'status_perkawinan' => $row[12] ?? null,
                        'nama_ayah' => $row[13] ?? null,
                        'nama_ibu' => $row[14] ?? null,
                        'no_hp' => $row[15] ?? null,
                        'status' => !empty($row[16]) ? filter_var($row[16], FILTER_VALIDATE_BOOLEAN) : true,
                        'agama' => $row[17] ?? null,
                        'pendidikan_terakhir' => $row[18] ?? null,
                        'pekerjaan' => $row[19] ?? null,
                        'status_dalam_keluarga' => $row[20] ?? null,
                    ];
                    
                    // Validasi data
                    $validator = \Validator::make($data, [
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
                        'agama' => 'nullable|string|max:50',
                        'pendidikan_terakhir' => 'nullable|string|max:100',
                        'pekerjaan' => 'nullable|string|max:100',
                        'status_dalam_keluarga' => 'nullable|in:Kepala Keluarga,Istri,Anak,Lain-lain',
                    ]);
                    
                    if ($validator->fails()) {
                        $errors[] = "Baris " . ($index + 2) . ": " . $validator->errors()->first();
                        continue;
                    }
                    
                    // Simpan data
                    Penduduk::create($data);
                    $imported++;
                    
                } catch (\Exception $e) {
                    $errors[] = "Baris " . ($index + 2) . ": " . $e->getMessage();
                }
            }
            
            $message = "Berhasil import {$imported} data penduduk.";
            if (count($errors) > 0) {
                $message .= " " . count($errors) . " data gagal diimport.";
            }
            
            return redirect()->route('penduduk.index')->with('success', $message);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal import data: ' . $e->getMessage());
        }
    }
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
            ->orderBy('nama', 'asc')
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
            'status' => 'nullable|boolean',
            'agama' => 'nullable|string|max:50',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'status_dalam_keluarga' => 'nullable|in:Kepala Keluarga,Istri,Anak,Lain-lain',
        ]);
        $validated['status'] = isset($validated['status']) ? (bool)$validated['status'] : true;
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
            'status' => 'nullable|boolean',
            'agama' => 'nullable|string|max:50',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'status_dalam_keluarga' => 'nullable|in:Kepala Keluarga,Istri,Anak,Lain-lain',
        ]);
        $validated['status'] = isset($validated['status']) ? (bool)$validated['status'] : false;
        $penduduk->update($validated);
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui!');
    }

    public function destroy(Penduduk $penduduk)
    {
        $this->authorize('delete penduduk');
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus!');
    }

    // API CRUD
    public function apiIndex(Request $request)
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
        return response()->json($penduduk);
    }

    public function apiShow(Penduduk $penduduk)
    {
        return response()->json($penduduk);
    }

    public function apiStore(Request $request)
    {
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
        $penduduk = Penduduk::create($validated);
        return response()->json($penduduk, 201);
    }

    public function apiUpdate(Request $request, Penduduk $penduduk)
    {
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
        return response()->json($penduduk);
    }

    public function apiDestroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return response()->json(['message' => 'Data penduduk berhasil dihapus']);
    }
}
