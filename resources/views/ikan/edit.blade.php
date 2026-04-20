<!DOCTYPE html>
<html>
<head>
    <title>Edit Ikan Cupang</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; }
        .current-image { margin: 10px 0; border: 1px solid #ddd; padding: 5px; border-radius: 5px; }
        .btn-update { background-color: #28a745; color: white; padding: 10px 15px; border: none; cursor: pointer; border-radius: 4px; }
        .btn-cancel { text-decoration: none; color: #666; margin-left: 10px; }
    </style>
</head>
<body>
    <h1>Edit Data Ikan: {{ $ikan->nama_ikan }}</h1>

    <form action="{{ route('ikan.update', $ikan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Ikan:</label><br>
            <input type="text" name="nama_ikan" value="{{ $ikan->nama_ikan }}" required>
        </div>

        <div class="form-group">
            <label>Jenis:</label><br>
            <input type="text" name="jenis" value="{{ $ikan->jenis }}" required>
        </div>

        <div class="form-group">
            <label>Harga:</label><br>
            <input type="number" name="harga" value="{{ $ikan->harga }}" required>
        </div>

        <div class="form-group">
            <label>Stok:</label><br>
            <input type="number" name="stok" value="{{ $ikan->stok }}" required>
        </div>

        <div class="form-group">
            <label>Foto Ikan Saat Ini:</label><br>
            <div class="current-image">
                @if($ikan->gambar)
                    <img src="{{ asset('storage/ikan/' . $ikan->gambar) }}" width="150" alt="Foto Ikan">
                    <p style="font-size: 12px; color: #666;">File: {{ $ikan->gambar }}</p>
                @else
                    <p style="color: red;">Belum ada foto / Gambar pecah</p>
                @endif
            </div>
            
            <label>Ganti Foto Baru:</label><br>
            <input type="file" name="gambar" accept="image/*">
            <p style="font-size: 12px; color: #888;">*Biarkan kosong jika tidak ingin mengubah foto</p>
        </div>

        <br>
        <button type="submit" class="btn-update">Update Data</button>
        <a href="{{ route('ikan.index') }}" class="btn-cancel">Batal</a>
    </form>
</body>
</html>