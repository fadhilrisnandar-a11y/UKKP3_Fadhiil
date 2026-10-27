
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan</title>

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

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #1e3a8a;
            color: white;
            padding: 28px 18px;
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 40px;
            line-height: 1.5;
        }

        .sidebar a {
            display: block;
            padding: 14px;
            color: #dbeafe;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            margin-left: 250px;
            padding: 30px;
        }

        .topbar {
            background: white;
            padding: 22px 25px;
            border-radius: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 28px;
            box-shadow: 0 4px 15px #0f172a08;
        }

        .topbar h1 {
            font-size: 23px;
        }

        .topbar p {
            color: #64748b;
            font-size: 14px;
            margin-top: 7px;
        }

        .logout {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            border-radius: 8px;
            padding: 11px 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .content {
            background: white;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 4px 15px #0f172a08;
        }

        .content h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .description {
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .alert {
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .search-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .search-form input,
        .search-form select {
            padding: 11px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: white;
            font-size: 14px;
        }

        .search-form input {
            flex: 1;
            min-width: 200px;
        }

        .btn {
            display: inline-block;
            border: none;
            background: #2563eb;
            color: white;
            padding: 10px 13px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
            font-size: 12px;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn:hover,
        .logout:hover {
            opacity: .85;
        }

        .btn-reset {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-delete {
            background: #dc2626;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1100px;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            vertical-align: middle;
        }

        th {
            background: #eff6ff;
            color: #1e3a8a;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
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

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .actions form {
            display: inline;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }

        .total {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 15px;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #94a3b8;
            font-size: 13px;
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                padding: 18px;
            }

            .sidebar h2 {
                margin-bottom: 15px;
            }

            .sidebar a {
                display: inline-block;
                padding: 10px;
                font-size: 13px;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .content {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <h2>📢 Pengaduan<br>Cafe</h2>

        <a href="{{ route('admin.dashboard') }}">
            🏠 Dashboard
        </a>

        <a href="{{ route('admin.pengaduan') }}" class="active">
            📋 Data Pengaduan
        </a>

        <a href="{{ route('admin.customer') }}">
            👥 Data Customer
        </a>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="main">

        {{-- HEADER --}}
        <header class="topbar">
            <div>
                <h1>Data Pengaduan</h1>
                <p>Selamat datang, {{ auth()->user()->name }}!</p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout">
                    Logout
                </button>
            </form>
        </header>

        {{-- DAFTAR PENGADUAN --}}
        <section class="content">

            <h2>Daftar Pengaduan Cafe</h2>

            <p class="description">
                Lihat laporan Cafe, cari pengaduan,
                dan pantau status penanganan laporan.
            </p>

            {{-- PESAN BERHASIL --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- PESAN ERROR --}}
            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            {{-- VALIDASI --}}
            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- PENCARIAN DAN FILTER --}}
            <form
                action="{{ route('admin.pengaduan') }}"
                method="GET"
                class="search-form"
            >
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama customer atau judul..."
                    value="{{ request('search') }}"
                >

                <select name="status">
                    <option value="">Semua Status</option>

                    <option
                        value="menunggu"
                        @selected(request('status') === 'menunggu')
                    >
                        Menunggu
                    </option>

                    <option
                        value="diproses"
                        @selected(request('status') === 'diproses')
                    >
                        Diproses
                    </option>

                    <option
                        value="selesai"
                        @selected(request('status') === 'selesai')
                    >
                        Selesai
                    </option>
                </select>

                <button type="submit" class="btn">
                    🔍 Cari
                </button>

                <a
                    href="{{ route('admin.pengaduan') }}"
                    class="btn btn-reset"
                >
                    Reset
                </a>
            </form>

            <p class="total">
                Total data ditampilkan: {{ $pengaduan->count() }} pengaduan
            </p>

            {{-- TABEL --}}
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Customer</th>
                            <th>Judul Pengaduan</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Nomor Meja</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pengaduan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $item->user->name ?? 'Tidak diketahui' }}
                                </td>

                                <td>
                                    {{ $item->judul ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->kategori ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->lokasi ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->nomor_meja ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->tanggal_pengaduan
                                        ? \Carbon\Carbon::parse($item->tanggal_pengaduan)->format('d-m-Y')
                                        : ($item->created_at?->format('d-m-Y') ?? '-') }}
                                </td>

                                <td>
                                    @php
                                        $status = strtolower($item->status ?? 'menunggu');
                                    @endphp

                                    <span class="badge {{ $status }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="{{ route('admin.pengaduan.detail', $item->id) }}"
                                            class="btn"
                                        >
                                            Detail
                                        </a>

                                        <form
                                            action="{{ route('admin.pengaduan.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-delete"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty">
                                    Belum ada data pengaduan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </section>

        <footer>
            &copy; {{ date('Y') }} Sistem Pengaduan Cafe
        </footer>

    </main>

</body>
</html>