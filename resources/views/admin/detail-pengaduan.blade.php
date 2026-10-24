
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pengaduan</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f1f5f9;color:#1e293b;padding:25px}
        .card{max-width:800px;margin:auto;background:white;padding:25px;border-radius:12px}
        .field{margin:18px 0;line-height:1.7}
        label{font-weight:bold;display:block;margin-bottom:5px}
        select,button{padding:11px;border-radius:7px;border:1px solid #cbd5e1}
        button{background:#2563eb;color:white;cursor:pointer}
        .alert{background:#dcfce7;color:#166534;padding:12px;border-radius:7px}
        img{max-width:100%;height:auto;border-radius:8px}
        a{color:#2563eb}
    </style>
</head>
<body>
<div class="card">
    <a href="{{ route('admin.pengaduan') }}">← Kembali ke daftar pengaduan</a>

    <h1>Detail Pengaduan</h1>

    @if(session('success'))
        <p class="alert">{{ session('success') }}</p>
    @endif

    <div class="field">
        <label>Nama Customer</label>
        {{ $item->user->name ?? 'Tidak diketahui' }}
    </div>

    <div class="field">
        <label>Email Customer</label>
        {{ $item->user->email ?? '-' }}
    </div>

    <div class="field">
        <label>Judul Pengaduan</label>
        {{ $item->judul ?? '-' }}
    </div>

    <div class="field">
        <label>Isi Pengaduan</label>
        {{ $item->isi ?? '-' }}
    </div>

    <div class="field">
        <label>Tanggal Pengaduan</label>
        {{ $item->tanggal_pengaduan ?? $item->created_at ?? '-' }}
    </div>

    <div class="field">
        <label>Status Saat Ini</label>
        {{ ucfirst($item->status ?? 'menunggu') }}
    </div>

    
<div class="field">
    <label>Foto Bukti Pengaduan</label>

    @if ($item->foto)
        <img
            src="{{ asset('storage/' . ltrim($item->foto, '/')) }}"
            alt="Foto bukti pengaduan"
            style="display:block;max-width:100%;max-height:450px;object-fit:contain;margin-top:10px;border:1px solid #e2e8f0;padding:5px;"
            onerror="this.style.display='none';this.nextElementSibling.style.display='block';"
        >

        <p style="display:none;color:#dc2626;margin-top:10px;">
            Foto tidak ditemukan. Periksa lokasi file foto di storage.
        </p>
    @else
        <p style="color:#64748b;">
            Customer belum mengunggah foto bukti pengaduan.
        </p>
    @endif
</div>


    <hr>

    <h2>Ubah Status</h2>

    <form action="{{ route('admin.pengaduan.status', $item->id) }}"
          method="POST">
        @csrf
        @method('PATCH')

        <select name="status" required>
            <option value="menunggu" @selected($item->status === 'menunggu')>
                Menunggu
            </option>
            <option value="diproses" @selected($item->status === 'diproses')>
                Diproses
            </option>
            <option value="selesai" @selected($item->status === 'selesai')>
                Selesai
            </option>
        </select>

        <button type="submit">Simpan Status</button>
    </form>

    @error('status')
        <p style="color:red">{{ $message }}</p>
    @enderror

    <hr style="margin:25px 0">

    <form action="{{ route('admin.pengaduan.destroy', $item->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
        @csrf
        @method('DELETE')

        <button type="submit" style="background:#dc2626">
            Hapus Pengaduan
        </button>
    </form>
</div>
</body>
</html>
