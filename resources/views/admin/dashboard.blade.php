<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

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

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 4px 15px #0f172a08;
            border-bottom: 4px solid #2563eb;
        }

        .card .icon {
            font-size: 27px;
            margin-bottom: 18px;
        }

        .card p {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .card h2 {
            font-size: 30px;
            color: #1e3a8a;
        }

        .section {
            background: white;
            padding: 28px;
            border-radius: 14px;
            margin-bottom: 25px;
        }

        .section h2 {
            font-size: 20px;
            margin-bottom: 12px;
        }

        .section p {
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        footer {
            text-align: center;
            padding: 20px;
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
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <h2>📢 Pengaduan<br>Cafe</h2>

        <a href="{{ url('/admin/dashboard') }}" class="active">
            🏠 Dashboard
        </a>

        <a href="{{ url('/admin/pengaduan') }}">
            📋 Data Pengaduan
        </a>

        <a href="{{ url('/admin/customer') }}">
            👥 Data Customer
        </a>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h1>Dashboard Admin</h1>
                <p>Selamat datang, {{ auth()->user()->name }}!</p>
            </div>

            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        </header>

        <section class="stats">
            <div class="card">
                <div class="icon">📋</div>
                <p>Total Pengaduan</p>
                <h2>{{ $totalPengaduan ?? 0 }}</h2>
            </div>

            <div class="card">
                <div class="icon">⏳</div>
                <p>Pengaduan Menunggu</p>
                <h2>{{ $menunggu ?? 0 }}</h2>
            </div>

            <div class="card">
                <div class="icon">🔄</div>
                <p>Sedang Diproses</p>
                <h2>{{ $diproses ?? 0 }}</h2>
            </div>

            <div class="card">
                <div class="icon">✅</div>
                <p>Pengaduan Selesai</p>
                <h2>{{ $selesai ?? 0 }}</h2>
            </div>
        </section>

        <section class="section">
            <h2>Kelola Pengaduan Cafe</h2>
            <p>
                Periksa laporan yang masuk, tinjau isi pengaduan,
                dan perbarui status penanganannya.
            </p>
            <a href="{{ url('/admin/pengaduan') }}" class="btn">
                Kelola Pengaduan
            </a>
        </section>

        <section class="section">
            <h2>Data Customer</h2>
            <p>
                Lihat data akun Cafe yang terdaftar pada aplikasi.
            </p>
            <a href="{{ url('/admin/customer') }}" class="btn">
                Lihat Data Customer
            </a>
        </section>

        <footer>
            &copy; {{ date('Y') }} Pengaduan Cafe - Admin
        </footer>

    </main>

</body>
</html>
