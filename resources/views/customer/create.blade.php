
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan</title>

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
            font-weight: bold;
            text-decoration: none;
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
            max-width: 900px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .page-header {
            background: linear-gradient(120deg, #2563eb, #60a5fa);
            color: white;
            padding: 30px;
            border-radius: 18px;
            margin-bottom: 25px;
        }

        .page-header h1 {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #eff6ff;
            line-height: 1.6;
        }

        .form-card {
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 4px 15px #0f172a08;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #334155;
            font-size: 14px;
        }

        .form-group input[type="text"],
        .form-group select,
        .form-group textarea,
        .form-group input[type="file"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s;
            background: #f8fafc;
            color: #1e293b;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px #2563eb22;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 130px;
        }

        .hint {
            color: #64748b;
            font-size: 12px;
            margin-top: 6px;
        }

        .error-msg {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success-msg {
            background: #dcfce7;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .btn-submit {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-submit:hover {
            background: #1d4ed8;
        }

        .btn-cancel {
            background: #e2e8f0;
            color: #475569;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            font-size: 14px;
            text-align: center;
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
                flex-wrap: wrap;
                gap: 12px;
            }

            .brand {
                font-size: 18px;
            }

            .nav-actions {
                flex-wrap: wrap;
            }

            .form-card {
                padding: 22px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('customer.dashboard') }}" class="brand">
            📢 Pengaduan Cafe
        </a>

        <div class="nav-actions">
            <a href="{{ route('customer.dashboard') }}" class="back">
                ← Kembali
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout" type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <main class="container">

        <section class="page-header">
            <h1>📝 Buat Pengaduan Baru</h1>
            <p>
                Isi formulir di bawah dengan lengkap agar laporan
                Anda dapat segera ditindaklanjuti.
            </p>
        </section>

        @if (session('success'))
            <div class="success-msg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-msg">
                <strong>⚠️ Perhatian:</strong>
                <ul style="margin-top:6px;padding-left:18px;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('customer.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="form-card"
        >
            @csrf

            <div class="form-group">
                <label for="judul">Judul Pengaduan</label>
                <input
                    type="text"
                    id="judul"
                    name="judul"
                    value="{{ old('judul') }}"
                    placeholder="Contoh: Fasilitas rusak"
                    maxlength="255"
                    required
                >
                <div class="hint">
                    Tulis judul singkat yang menggambarkan masalah.
                </div>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori Pengaduan</label>
                <select id="kategori" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Infrastruktur"
                        {{ old('kategori') == 'Infrastruktur' ? 'selected' : '' }}>
                        Infrastruktur
                    </option>
                    <option value="Kebersihan"
                        {{ old('kategori') == 'Kebersihan' ? 'selected' : '' }}>
                        Kebersihan
                    </option>
                    <option value="Keamanan"
                        {{ old('kategori') == 'Keamanan' ? 'selected' : '' }}>
                        Keamanan
                    </option>
                    <option value="Pelayanan"
                        {{ old('kategori') == 'Pelayanan' ? 'selected' : '' }}>
                        Pelayanan
                    </option>
                    <option value="Lainnya"
                        {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>
                        Lainnya
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi Kejadian</label>
                <input
                    type="text"
                    id="lokasi"
                    name="lokasi"
                    value="{{ old('lokasi') }}"
                    maxlength="255"
                    required
                >
                <div class="hint">
                    Masukkan alamat atau tempat terjadinya masalah.
                </div>
            </div>

            <div class="form-group">
                <label for="nomor_meja">Nomor Meja (Opsional)</label>
                <input
                    type="text"
                    id="nomor_meja"
                    name="nomor_meja"
                    value="{{ old('nomor_meja') }}"
                    placeholder="Contoh: Meja 05"
                    maxlength="20"
                >
                <div class="hint">
                    Isi jika pengaduan berkaitan dengan meja tertentu.
                </div>
            </div>

            <div class="form-group">
                <label for="isi">Isi Pengaduan</label>
                <textarea
                    id="isi"
                    name="isi"
                    placeholder="Ceritakan masalah secara detail..."
                    required
                >{{ old('isi') }}</textarea>
                <div class="hint">
                    Jelaskan kronologi, lokasi, dan dampak masalah.
                </div>
            </div>

            <div class="form-group">
                <label for="foto">Upload Bukti (Opsional)</label>
                <input
                    type="file"
                    id="foto"
                    name="foto"
                    accept=".jpg,.jpeg,.png"
                >
                <div class="hint">
                    Format JPG atau PNG. Maksimal 2 MB.
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('customer.index') }}" class="btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn-submit">
                    Kirim Pengaduan
                </button>
            </div>
        </form>

    </main>

    <footer>
        &copy; {{ date('Y') }} Pengaduan Cafe
    </footer>

</body>
</html>
