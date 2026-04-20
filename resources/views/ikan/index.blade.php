<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Ikan Cupang</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px; background-color: #f4f4f9; }
        h1 { color: #333; }
        .btn-tambah { 
            display: inline-block; background-color: blue; color: white; 
            padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-bottom: 20px; 
        }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f8f8f8; }
        tr:hover { background-color: #f1f1f1; }
        .img-cupang { border-radius: 8px; object-fit: cover; border: 1px solid #eee; }
        .btn-edit { color: green; text-decoration: none; font-weight: bold; margin-right: 10px; }
        .btn-hapus { background: none; border: none; color: red; cursor: pointer; font-weight: bold; text-decoration: underline; padding: 0; }
    </style>
</head>
<body>

    <h1>Koleksi Ikan Cupang</h1>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ikan.create') }}" class="btn-tambah">+ Tambah Ikan Baru</a>

    <table>
        <thead>
            <tr>
                <th>Nama Ikan</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semuaIkan as $ikan)
            <tr>
                <td>{{ $ikan->nama_ikan }}</td>
                <td>{{ $ikan->jenis }}</td>
                <td>Rp {{ number_format($ikan->harga, 0, ',', '.') }}</td>
                <td>{{ $ikan->stok }}</td>
                
                <td style="text-align: center;">
                    @if($ikan->gambar)
                        <img src="{{ asset('storage/ikan/' . $ikan->gambar) }}" width="80" height="80" class="img-cupang">
                    @else
                        <small style="color: #999;">Tidak ada foto</small>
                    @endif
                </td>

                <td>
                    <a href="{{ route('ikan.edit', $ikan->id) }}" class="btn-edit">Edit</a>
                    
                    <form action="{{ route('ikan.destroy', $ikan->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus ikan {{ $ikan->nama_ikan }}?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>