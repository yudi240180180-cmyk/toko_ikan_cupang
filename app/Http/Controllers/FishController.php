<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fish;
use Illuminate\Support\Facades\Storage;

class FishController extends Controller
{
    /**
     * Menampilkan data di halaman depan (Welcome)
     */
    public function welcome()
    {
        $semuaIkan = Fish::all();
        // Kita arahkan ke welcome.blade.php sambil membawa data ikan
        return view('welcome', compact('semuaIkan'));
    }

    /**
     * Tampilkan semua data ikan di halaman admin (/ikan)
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
        $request->validate([
            'nama_ikan' => 'required',
            'jenis'     => 'required',
            'harga'     => 'required|numeric',
            'stok'      => 'required|numeric',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('ikan', $nama_file, 'public'); 
            $data['gambar'] = $nama_file;
        }

        Fish::create($data);

        return redirect()->route('ikan.index')->with('success', 'Ikan dan fotonya berhasil ditambah!');
    }

    // ... (Fungsi show, edit, update, destroy tetap sama seperti kodingan Anda)

    public function edit(string $id)
    {
        $ikan = Fish::findOrFail($id);
        return view('ikan.edit', compact('ikan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_ikan' => 'required',
            'jenis'     => 'required',
            'harga'     => 'required|numeric',
            'stok'      => 'required|numeric',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        $ikan = Fish::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($ikan->gambar) {
                Storage::disk('public')->delete('ikan/' . $ikan->gambar);
            }
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('ikan', $nama_file, 'public');
            $data['gambar'] = $nama_file;
        }

        $ikan->update($data);
        return redirect()->route('ikan.index')->with('success', 'Data ikan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $ikan = Fish::findOrFail($id);
        if ($ikan->gambar) {
            Storage::disk('public')->delete('ikan/' . $ikan->gambar);
        }
        $ikan->delete();
        return redirect()->route('ikan.index')->with('success', 'Ikan berhasil dihapus!');
    }
}