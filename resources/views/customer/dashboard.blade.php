
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer - Pengaduan Cafe</title>

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
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
            color: #475569;
            font-size: 14px;
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

        .welcome {
            background: linear-gradient(120deg, #2563eb, #60a5fa);
            color: white;
            padding: 35px;
            border-radius: 18px;
            margin-bottom: 28px;
        }

        .welcome h1 {
            font-size: 28px;
            margin-bottom: 12px;
        }

        .welcome p {
            line-height: 1.7;
            color: #eff6ff;
            max-width: 650px;
        }

        .section-title {
            margin-bottom: 18px;
            font-size: 21px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 15px #0f172a08;
            border: 1px solid #e2e8f0;
        }

        .card .icon {
            font-size: 27px;
            margin-bottom: 18px;
        }

        .card h3 {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .number {
            font-size: 30px;
            font-weight: bold;
            color: #1e3a8a;
        }

        .actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .action-card {
            background: white;
            padding: 27px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px #0f172a08;
            transition: 0.2s;
        }

        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px #0f172a0d;
        }

        .action-icon {
            width: 52px;
            height: 52px;
            background: #dbeafe;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            font-size: 25px;
            margin-bottom: 18px;
        }

        .action-card h3 {
            margin-bottom: 12px;
            font-size: 18px;
        }

        .action-card p {
            color: #64748b;
            line-height: 1.7;
            font-size: 14px;
            margin-bottom: 22px;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .info-box {
            margin-top: 30px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 22px;
            border-radius: 12px;
        }

        .info-box h3 {
            color: #1d4ed8;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .info-box p {
            color: #475569;
            font-size: 14px;
            line-height: 1.8;
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
                gap: 12px;
                flex-wrap: wrap;
            }

            .brand {
                font-size: 18px;
            }

            .nav-right {
                gap: 8px;
            }

            .user-name {
                display: none;
            }

            .welcome {
                padding: 25px;
            }

            .welcome h1 {
                font-size: 23px;
            }

            .container {
                margin-top: 25px;
            }

            .card,
            .action-card {
                padding: 22px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="brand">📢 Pengaduan Cafe</div>

        <div class="nav-right">
            <span class="user-name">
                {{ auth()->user()->name }}
            </span>

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

        <section class="welcome">
            <h1>Halo, {{ auth()->user()->name }}! 👋</h1>
            <p>
                Selamat datang di dashboard customer.
                Sampaikan pengaduan Anda, lengkapi informasi kejadian,
                dan pantau perkembangan laporan dengan mudah melalui
                sistem ini.
            </p>
        </section>

        <h2 class="section-title">Ringkasan Pengaduan</h2>

        <section class="stats">
            <div class="card">
                <div class="icon">📋</div>
                <h3>Total Pengaduan</h3>
                <div class="number">{{ $totalPengaduan ?? 0 }}</div>
            </div>

            <div class="card">
                <div class="icon">⏳</div>
                <h3>Menunggu Diproses</h3>
                <div class="number">{{ $menunggu ?? 0 }}</div>
            </div>

            <div class="card">
                <div class="icon">✅</div>
                <h3>Pengaduan Selesai</h3>
                <div class="number">{{ $selesai ?? 0 }}</div>
            </div>
        </section>

        <h2 class="section-title">Menu Customer</h2>

        <section class="actions">

            <div class="action-card">
                <div class="action-icon">📝</div>

                <h3>Buat Pengaduan</h3>

                <p>
                    Buat laporan baru dengan mengisi judul, kategori,
                    lokasi kejadian, isi pengaduan, dan bukti foto.
                    Nomor meja dapat diisi jika diperlukan.
                </p>

                <a href="{{ route('customer.create') }}" class="btn">
                    + Buat Pengaduan
                </a>
            </div>

            <div class="action-card">
                <div class="action-icon">📂</div>

                <h3>Riwayat Pengaduan</h3>

                <p>
                    Lihat daftar pengaduan yang pernah Anda kirim,
                    informasi laporan, dan status perkembangan
                    setiap pengaduan.
                </p>

                <a href="{{ route('customer.index') }}" class="btn">
                    Lihat Pengaduan
                </a>
            </div>

        </section>

        <section class="info-box">
            <h3>💡 Informasi Pengaduan</h3>
            <p>
                Pastikan judul dan isi laporan ditulis dengan jelas.
                Pilih kategori yang sesuai dan masukkan lokasi kejadian
                dengan benar agar laporan lebih mudah ditindaklanjuti.
                Jika memiliki bukti foto, Anda dapat melampirkannya
                saat membuat pengaduan.
            </p>
        </section>

    </main>

    <footer>
        &copy; {{ date('Y') }} Pengaduan Cafe
    </footer>

</body>
</html>
