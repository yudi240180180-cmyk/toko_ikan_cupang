<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Ikan Cupang Yudi</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-align: center; padding: 50px; background-color: #f8f9fa; }
        h1 { color: #333; }
        .ikan-list { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-top: 30px; }
        .card { 
            border: 1px solid #ddd; 
            padding: 20px; 
            border-radius: 15px; 
            background: white; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 250px;
            transition: transform 0.2s;
        }
        .card:hover { transform: scale(1.05); }
        .card img { width: 100%; height: 180px; object-fit: cover; border-radius: 10px; margin-bottom: 15px; }
        .harga { font-weight: bold; color: #28a745; font-size: 1.2em; }
        .stok { color: #666; font-size: 0.9em; }
        .btn-admin { display: inline-block; margin-top: 40px; text-decoration: none; color: #007bff; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Selamat Datang di Toko Ikan Cupang Yudi</h1>
    <p>Katalog Ikan Cupang Berkualitas Tinggi.</p>

    <div class="ikan-list">
        @forelse($semuaIkan as $ikan)
            <div class="card">
                @if($ikan->gambar)
                    {{-- Di sini disesuaikan dengan folder 'public/storage/ikan' --}}
                    <img src="{{ asset('storage/ikan/' . $ikan->gambar) }}" alt="{{ $ikan->nama_ikan }}">
                @else
                    <img src="https://via.placeholder.com/250x180?text=Tidak+Ada+Foto" alt="No Image">
                @endif
                
                <h3>{{ $ikan->nama_ikan }}</h3>
                <p class="stok">Jenis: {{ $ikan->jenis }}</p>
                <p class="harga">Rp {{ number_format($ikan->harga, 0, ',', '.') }}</p>
                <p class="stok">Stok tersedia: {{ $ikan->stok }}</p>
            </div>
        @empty
            <p>Belum ada koleksi ikan saat ini. Silakan tambah data di halaman admin.</p>
        @endforelse
    </div>

    <a href="{{ url('/ikan') }}" class="btn-admin">→ Kelola Stok Ikan (Admin)</a>

</body>
</html>