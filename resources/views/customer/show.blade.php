
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #1e293b;
            padding: 25px;
        }

        .container {
            max-width: 850px;
            margin: 25px auto;
        }

        .header {
            background: linear-gradient(120deg, #1e3a8a, #3b82f6);
            color: white;
            padding: 25px;
            border-radius: 14px;
            margin-bottom: 22px;
        }

        .header h1 {
            font-size: 25px;
            margin-bottom: 8px;
        }

        .header p {
            color: #dbeafe;
            line-height: 1.6;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 4px 15px #0f172a08;
            margin-bottom: 20px;
        }

        .back {
            display: inline-block;
            margin-bottom: 22px;
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .field {
            margin-bottom: 22px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .field label {
            display: block;
            color: #64748b;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .value {
            font-size: 15px;
            white-space: pre-line;
        }

        .badge {
            display: inline-block;
            padding: 8px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .menunggu {
            background: #fef3c7;
            color: #92400e;
        }

        .diproses {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .selesai {
            background: #dcfce7;
            color: #166534;
        }

        .ditolak {
            background: #fee2e2;
            color: #b91c1c;
        }

        .foto {
            display: block;
            max-width: 100%;
            max-height: 500px;
            object-fit: contain;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 5px;
            margin-top: 10px;
        }

        .alert {
            background: #dcfce7;
            color: #166534;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 11px 17px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        footer {
            text-align: center;
            color: #94a3b8;
            padding: 20px;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .card {
                padding: 20px;
            }

            .header h1 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <header class="header">
        <h1>📋 Detail Pengaduan</h1>
        <p>Lihat informasi dan perkembangan laporan pengaduan Anda.</p>
    </header>

    <section class="card">

        <a href="{{ route('customer.index') }}" class="back">
            ← Kembali ke Riwayat Pengaduan
        </a>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="field">
            <label>ID Pengaduan</label>
            <div class="value">#{{ $item->id }}</div>
        </div>

        <div class="field">
            <label>Judul Pengaduan</label>
            <div class="value">{{ $item->judul ?? '-' }}</div>
        </div>

        <div class="field">
            <label>Isi Pengaduan</label>
            <div class="value">{{ $item->isi ?? '-' }}</div>
        </div>

        <div class="field">
            <label>Tanggal Pengaduan</label>
            <div class="value">
                @if ($item->tanggal_pengaduan)
                    {{ \Carbon\Carbon::parse($item->tanggal_pengaduan)->format('d F Y') }}
                @elseif ($item->created_at)
                    {{ $item->created_at->format('d F Y') }}
                @else
                    -
                @endif
            </div>
        </div>

        <div class="field">
            <label>Status Pengaduan</label>

            @php
                $status = strtolower($item->status ?? 'menunggu');

                $statusClass = in_array(
                    $status,
                    ['menunggu', 'diproses', 'selesai', 'ditolak']
                ) ? $status : 'menunggu';

                $statusLabel = [
                    'menunggu' => 'Menunggu',
                    'diproses' => 'Sedang Diproses',
                    'selesai' => 'Selesai',
                    'ditolak' => 'Ditolak',
                ][$status] ?? ucfirst($status);
            @endphp

            <span class="badge {{ $statusClass }}">
                {{ $statusLabel }}
            </span>
        </div>

        <div class="field">
            <label>Foto Bukti Pengaduan</label>

            @if ($item->foto)
                @php
                    $fotoPath = ltrim($item->foto, '/');

                    if (str_starts_with($fotoPath, 'storage/')) {
                        $fotoPath = substr($fotoPath, 8);
                    }

                    $fotoUrl = asset('storage/' . $fotoPath);
                @endphp

                <img
                    src="{{ $fotoUrl }}"
                    alt="Foto bukti pengaduan"
                    class="foto"
                    onerror="this.style.display='none';document.getElementById('foto-error').style.display='block';"
                >

                <p id="foto-error"
                   style="display:none;color:#dc2626;margin-top:10px;">
                    Foto tidak ditemukan. Periksa lokasi file di storage.
                </p>

                <p style="margin-top:10px;">
                    <a href="{{ $fotoUrl }}" target="_blank"
                       rel="noopener noreferrer">
                        Buka Foto
                    </a>
                </p>
            @else
                <p style="color:#64748b;">
                    Tidak ada foto bukti yang diunggah.
                </p>
            @endif
        </div>
    
    </section>

    <footer>
        &copy; {{ date('Y') }} Pengaduan Masyarakat
    </footer>

</div>

</body>
</html>
