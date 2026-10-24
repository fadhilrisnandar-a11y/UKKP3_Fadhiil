
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengaduan</title>

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
        }

        .navbar {
            background: white;
            padding: 20px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px #00000008;
        }

        .brand {
            color: #2563eb;
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .back {
            background: #e0e7ff;
            color: #2563eb;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .logout {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .container {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .page-header {
            background: linear-gradient(120deg, #2563eb, #60a5fa);
            color: white;
            padding: 30px;
            border-radius: 18px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-header h1 {
            font-size: 26px;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #eff6ff;
            line-height: 1.6;
        }

        .btn-add {
            background: white;
            color: #2563eb;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-add:hover {
            background: #eff6ff;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .empty {
            background: white;
            padding: 60px 25px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 4px 15px #0f172a08;
        }

        .empty .icon {
            font-size: 60px;
            margin-bottom: 15px;
        }

        .empty h3 {
            color: #475569;
            margin-bottom: 8px;
        }

        .empty p {
            color: #94a3b8;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .pengaduan-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .pengaduan-card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 4px 15px #0f172a08;
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            transition: 0.2s;
            min-width: 0;
        }

        .pengaduan-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px #0f172a15;
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 14px;
            gap: 10px;
        }

        .card-top h3 {
            font-size: 17px;
            color: #1e293b;
            line-height: 1.4;
            flex: 1;
            overflow-wrap: anywhere;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .badge-menunggu {
            background: #fef3c7;
            color: #b45309;
        }

        .badge-diproses,
        .badge-proses {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-selesai {
            background: #d1fae5;
            color: #047857;
        }

        .badge-ditolak {
            background: #fee2e2;
            color: #b91c1c;
        }

        .badge-lainnya {
            background: #e2e8f0;
            color: #475569;
        }

        .card-meta {
            color: #64748b;
            font-size: 12px;
            margin-bottom: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px 12px;
        }

        .card-body {
            color: #475569;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 18px;
            flex: 1;
            overflow-wrap: anywhere;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-image {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .card-actions {
            display: flex;
            gap: 8px;
            border-top: 1px solid #f1f5f9;
            padding-top: 15px;
            align-items: stretch;
        }

        .btn-detail {
            flex: 1;
            text-align: center;
            background: #2563eb;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-detail:hover {
            background: #1d4ed8;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        .delete-form {
            margin: 0;
        }

        footer {
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            padding: 30px 15px;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 18px 5%;
                gap: 10px;
            }

            .brand {
                font-size: 16px;
            }

            .nav-actions {
                gap: 6px;
            }

            .back,
            .logout {
                padding: 9px 10px;
                font-size: 12px;
            }

            .page-header {
                padding: 22px;
            }

            .page-header h1 {
                font-size: 21px;
            }

            .pengaduan-list {
                grid-template-columns: 1fr;
            }

            .pengaduan-card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <a href="{{ route('customer.dashboard') }}" class="brand">
            📢 Pengaduan Masyarakat
        </a>

        <div class="nav-actions">
            <a href="{{ route('customer.dashboard') }}" class="back">
                ← Dashboard
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout" type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <main class="container">

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <section class="page-header">
            <div>
                <h1>📂 Riwayat Pengaduan</h1>
                <p>Daftar seluruh pengaduan yang pernah Anda kirim.</p>
            </div>

            <a href="{{ route('customer.create') }}" class="btn-add">
                + Buat Baru
            </a>
        </section>

        @if ($pengaduan->count() > 0)

            <section class="pengaduan-list">

                @foreach ($pengaduan as $p)

                    <article class="pengaduan-card">

                        <div class="card-top">
                            <h3>{{ $p->judul }}</h3>

                            @php
                                $status = strtolower($p->status ?? 'menunggu');

                                $label = [
                                    'menunggu' => 'Menunggu',
                                    'proses' => 'Diproses',
                                    'diproses' => 'Diproses',
                                    'selesai' => 'Selesai',
                                    'ditolak' => 'Ditolak',
                                ][$status] ?? ucfirst($status);

                                $badgeClass = in_array(
                                    $status,
                                    ['menunggu', 'proses', 'diproses', 'selesai', 'ditolak']
                                ) ? 'badge-' . $status : 'badge-lainnya';
                            @endphp

                            <span class="badge {{ $badgeClass }}">
                                {{ $label }}
                            </span>
                        </div>

                        <div class="card-meta">
                            <span>
                                📅
                                {{ $p->tanggal_pengaduan
                                    ? \Carbon\Carbon::parse($p->tanggal_pengaduan)->format('d M Y')
                                    : $p->created_at->format('d M Y') }}
                            </span>

                            <span>🆔 #{{ $p->id }}</span>
                        </div>

                        @if ($p->foto)
                            <img
                                src="{{ asset('storage/' . $p->foto) }}"
                                alt="Bukti pengaduan"
                                class="card-image"
                                onerror="this.style.display='none';"
                            >
                        @endif

                        <div class="card-body">
                            {{ $p->isi }}
                        </div>

                        <div class="card-actions">

                            <a
                                href="{{ route('customer.show', $p->id) }}"
                                class="btn-detail"
                            >
                                Lihat Detail
                            </a>

                            @if ($status === 'menunggu')
                                <form
                                    action="{{ route('customer.destroy', $p->id) }}"
                                    method="POST"
                                    class="delete-form"
                                    onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            @endif

                        </div>

                    </article>

                @endforeach

            </section>

        @else

            <section class="empty">
                <div class="icon">📭</div>

                <h3>Belum Ada Pengaduan</h3>

                <p>
                    Anda belum mengirimkan pengaduan apa pun.
                    Yuk, mulai sampaikan laporan Anda!
                </p>

                <a
                    href="{{ route('customer.create') }}"
                    class="btn-detail"
                    style="display: inline-block; padding: 12px 24px; flex: none;"
                >
                    Buat Pengaduan Pertama
                </a>
            </section>

        @endif

    </main>

    <footer>
        &copy; {{ date('Y') }} Pengaduan Masyarakat
    </footer>

</body>
</html>
