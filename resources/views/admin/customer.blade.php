
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - Admin</title>

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

        .topbar, .section {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 15px #0f172a08;
        }

        .topbar {
            padding: 22px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
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

        .section {
            padding: 25px;
        }

        .section h2 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .description {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 22px;
        }

        .search-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .search {
            width: 100%;
            max-width: 320px;
            padding: 11px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .btn-add {
            background: #16a34a;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .reset {
            background: #64748b;
        }

        .btn-edit {
            background: #f59e0b;
        }

        .btn-delete {
            background: #dc2626;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-buttons form {
            margin: 0;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        thead {
            background: #eff6ff;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        th {
            color: #1e3a8a;
            white-space: nowrap;
        }

        td {
            color: #475569;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 25px;
        }

        .count {
            margin-top: 18px;
            color: #64748b;
            font-size: 13px;
        }

        .pagination {
            margin-top: 20px;
        }

        footer {
            text-align: center;
            padding: 25px 10px;
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

            .section {
                padding: 18px;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>📢 Pengaduan<br>Cafe</h2>

        <a href="{{ url('/admin/dashboard') }}">
            🏠 Dashboard
        </a>

        <a href="{{ url('/admin/pengaduan') }}">
            📋 Data Pengaduan
        </a>

        <a href="{{ url('/admin/customer') }}" class="active">
            👥 Data User
        </a>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">
            <div>
                <h1>Data User</h1>
                <p>Daftar akun Cafe yang terdaftar di aplikasi.</p>
            </div>

            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        </header>

        <!-- TABEL DATA USER -->
        <section class="section">

            <h2>Tabel Data User</h2>

            <p class="description">
                Kelola akun Cafe yang terdaftar di aplikasi.
            </p>

            <!-- NOTIFIKASI BERHASIL -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- NOTIFIKASI ERROR -->
            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <!-- PESAN VALIDASI -->
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul style="padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- CREATE: TAMBAH USER -->
            <a href="{{ route('admin.customer.create') }}"
               class="btn btn-add">
                + Tambah User
            </a>

            <!-- FORM SEARCH -->
            <form action="{{ url('/admin/customer') }}"
                  method="GET"
                  class="search-form">

                <input
                    type="text"
                    name="search"
                    class="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau email user..."
                >

                <button type="submit" class="btn">
                    🔍 Cari
                </button>

                <a href="{{ url('/admin/customer') }}"
                   class="btn reset">
                    Reset
                </a>
            </form>

            <!-- READ: TABEL USER -->
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Tanggal Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    {{ ($users->firstItem() ?? 1) + $loop->index }}
                                </td>

                                <td>{{ $user->name }}</td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    {{ $user->created_at
                                        ? $user->created_at->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td>
                                    <div class="action-buttons">

                                        <!-- UPDATE: EDIT USER -->
                                        <a
                                            href="{{ route('admin.customer.edit', $user->id) }}"
                                            class="btn btn-edit">
                                            ✏️ Edit
                                        </a>

                                        <!-- DELETE: HAPUS USER -->
                                        <form
                                            action="{{ route('admin.customer.destroy', $user->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-delete">
                                                🗑️ Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="empty">
                                    Belum ada data user yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- JUMLAH USER -->
            <p class="count">
                Total user terdaftar: {{ $users->total() }}
            </p>

            <!-- PAGINATION -->
            <div class="pagination">
                {{ $users->links() }}
            </div>

        </section>

        <!-- FOOTER -->
        <footer>
            &copy; {{ date('Y') }} Pengaduan Cafe - Admin
        </footer>

    </main>

</body>
</html>
