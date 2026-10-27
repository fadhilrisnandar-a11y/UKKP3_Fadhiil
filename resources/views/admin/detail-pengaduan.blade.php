
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pengaduan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            padding: 25px;
        }

        .card {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .field {
            margin: 18px 0;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        select,
        button {
            padding: 11px;
            border-radius: 7px;
            border: 1px solid #cbd5e1;
        }

        select {
            min-width: 180px;
            background: white;
        }

        button {
            background: #2563eb;
            color: white;
            cursor: pointer;
            border: none;
        }

        button:hover {
            opacity: 0.9;
        }

        .alert {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 7px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 7px;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        hr {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 25px 0;
        }

        .btn-danger {
            background: #dc2626;
        }

        .status-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }
    </style>
</head>

<body>

<div class="card">

    <a href="{{ route('admin.pengaduan') }}">
        ← Kembali ke daftar pengaduan
    </a>

    <h1>Detail Pengaduan</h1>

    {{-- Pesan berhasil --}}
    @if(session('success'))
        <p class="alert">
            {{ session('success') }}
        </p>
    @endif

    {{-- Pesan gagal --}}
    @if(session('error'))
        <p class="alert-error">
            {{ session('error') }}
        </p>
    @endif

    {{-- Data customer --}}
    <div class="field">
        <label>Nama Customer</label>
        {{ $item->user->name ?? 'Tidak diketahui' }}
    </div>

    <div class="field">
        <label>Email Customer</label>
        {{ $item->user->email ?? '-' }}
    </div>

    {{-- Informasi pengaduan --}}
    <div class="field">
        <label>Judul Pengaduan</label>
        {{ $item->judul ?? '-' }}
    </div>

    <div class="field">
        <label>Kategori Pengaduan</label>
        {{ $item->kategori ?? '-' }}
    </div>

    <div class="field">
        <label>Lokasi Pengaduan</label>
        {{ $item->lokasi ?? '-' }}
    </div>

    <div class="field">
        <label>Nomor Meja</label>
        {{ $item->nomor_meja ?? '-' }}
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

    {{-- Foto bukti --}}
    <div class="field">
        <label>Foto Bukti Pengaduan</label>

        @if($item->foto)
            @php
                $fotoPath = ltrim($item->foto, '/');

                if (str_starts_with($fotoPath, 'storage/')) {
                    $fotoPath = substr($fotoPath, strlen('storage/'));
                }
            @endphp

            <img
                src="{{ asset('storage/' . $fotoPath) }}"
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

    {{-- Ubah status --}}
    <h2>Ubah Status</h2>

    <form
        action="{{ route('admin.pengaduan.status', $item->id) }}"
        method="POST"
    >
        @csrf
        @method('PATCH')

        <div class="status-form">
            <select name="status" required>
                <option value="menunggu"
                    @selected($item->status === 'menunggu')>
                    Menunggu
                </option>

                <option value="diproses"
                    @selected($item->status === 'diproses')>
                    Diproses
                </option>

                <option value="selesai"
                    @selected($item->status === 'selesai')>
                    Selesai
                </option>
            </select>

            <button type="submit">
                Simpan Status
            </button>
        </div>
    </form>

    @error('status')
        <p style="color:red;margin-top:10px;">
            {{ $message }}
        </p>
    @enderror

    <hr>

    {{-- Hapus pengaduan --}}
    <h2>Hapus Pengaduan</h2>

    <form
        action="{{ route('admin.pengaduan.destroy', $item->id) }}"
        method="POST"
        onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')"
    >
        @csrf
        @method('DELETE')

        <button type="submit" class="btn-danger">
            Hapus Pengaduan
        </button>
    </form>

</div>

</body>
</html>
