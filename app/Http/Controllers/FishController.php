<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fish;
use Illuminate\Support\Facades\Storage;

class FishController extends Controller
{
    /**
     * Tampilkan semua data ikan.
     */
    public function index()
    {
        $semuaIkan = Fish::all();
        return view('ikan.index', compact('semuaIkan'));
    }

    /**
     * Tampilkan form tambah ikan.
     */
    public function create()
    {
        return view('ikan.create');
    }

    /**
     * Simpan data ikan baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'nama_ikan' => 'required',
            'jenis'     => 'required',
            'harga'     => 'required|numeric',
            'stok'      => 'required|numeric',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // 2. Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            
            // Simpan ke storage/app/public/ikan/
            // Parameter ketiga 'public' memastikan disk yang digunakan benar
            $file->storeAs('ikan', $nama_file, 'public'); 
            
            $data['gambar'] = $nama_file;
        }

        // 3. Simpan ke database
        Fish::create($data);

        return redirect()->route('ikan.index')->with('success', 'Ikan dan fotonya berhasil ditambah!');
    }

    /**
     * Tampilkan detail ikan (Opsional).
     */
    public function show(string $id)
    {
        $ikan = Fish::findOrFail($id);
        return view('ikan.show', compact('ikan'));
    }

    /**
     * Tampilkan form edit ikan.
     */
    public function edit(string $id)
    {
        $ikan = Fish::findOrFail($id);
        return view('ikan.edit', compact('ikan'));
    }

    /**
     * Perbarui data ikan di database.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validasi
        $request->validate([
            'nama_ikan' => 'required',
            'jenis'     => 'required',
            'harga'     => 'required|numeric',
            'stok'      => 'required|numeric',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        $ikan = Fish::findOrFail($id);
        $data = $request->all();

        // 2. Cek jika user mengunggah gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari folder storage/app/public/ikan jika ada
            if ($ikan->gambar) {
                Storage::disk('public')->delete('ikan/' . $ikan->gambar);
            }

            // Upload gambar baru
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('ikan', $nama_file, 'public');
            
            $data['gambar'] = $nama_file;
        }

        // 3. Update database
        $ikan->update($data);

        return redirect()->route('ikan.index')->with('success', 'Data ikan berhasil diperbarui!');
    }

    /**
     * Hapus data ikan.
     */
    public function destroy(string $id)
    {
        $ikan = Fish::findOrFail($id);
        
        // Hapus file fisik dari folder storage agar tidak menumpuk sampah
        if ($ikan->gambar) {
            Storage::disk('public')->delete('ikan/' . $ikan->gambar);
        }

        $ikan->delete();
        return redirect()->route('ikan.index')->with('success', 'Ikan berhasil dihapus!');
    }
}