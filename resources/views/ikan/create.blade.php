<!DOCTYPE html>
<html>
<head>
    <title>Tambah Ikan Cupang</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; }
        button { background: blue; color: white; padding: 10px 20px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Tambah Ikan Cupang Baru</h1>

    <form action="{{ route('ikan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label>Nama Ikan:</label>
            <input type="text" name="nama_ikan" required placeholder="Contoh: Blue Rim">
        </div>

        <div class="form-group">
            <label>Jenis:</label>
            <input type="text" name="jenis" required placeholder="Contoh: Plakat">
        </div>

        <div class="form-group">
            <label>Harga:</label>
            <input type="number" name="harga" required>
        </div>

        <div class="form-group">
            <label>Stok:</label>
            <input type="number" name="stok" required>
        </div>

        <div class="form-group">
            <label>Foto Ikan:</label>
            <input type="file" name="gambar" accept="image/*">
            <small>Format: jpg, png, jpeg (Maks 2MB)</small>
        </div>

        <br>
        <button type="submit">Simpan Ikan</button>
        <a href="{{ route('ikan.index') }}">Batal</a>
    </form>
</body>
</html>