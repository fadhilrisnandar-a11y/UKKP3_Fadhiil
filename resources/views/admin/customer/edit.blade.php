
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin</title>

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
            min-height: 100vh;
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
            max-width: 800px;
            padding: 25px;
        }

        .section h2 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .description {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #2563eb18;
        }

        .hint {
            margin-top: 7px;
            color: #64748b;
            font-size: 12px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 7px;
        }

        .alert {
            background: #fee2e2;
            color: #991b1b;
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 12px 17px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-back {
            background: #64748b;
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
                min-height: auto;
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

    <aside class="sidebar">
        <h2>📢 Pengaduan<br>Masyarakat</h2>

        <a href="{{ url('/admin/dashboard') }}">🏠 Dashboard</a>
        <a href="{{ url('/admin/pengaduan') }}">📋 Data Pengaduan</a>
        <a href="{{ route('admin.customer') }}" class="active">
            👥 Data User
        </a>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h1>Edit User</h1>
                <p>Perbarui informasi akun masyarakat.</p>
            </div>

            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        </header>

        <section class="section">
            <h2>Form Edit User</h2>

            <p class="description">
                Ubah nama atau email. Password boleh dikosongkan
                jika tidak ingin menggantinya.
            </p>

            @if ($errors->any())
                <div class="alert">
                    <strong>Periksa kembali data berikut:</strong>
                    <ul style="padding-left: 20px; margin-top: 8px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('admin.customer.update', $customer->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $customer->name) }}"
                        maxlength="255"
                        required
                    >
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $customer->email) }}"
                        maxlength="255"
                        required
                    >
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Kosongkan jika tidak diubah"
                        minlength="8"
                        autocomplete="new-password"
                    >
                    <p class="hint">
                        Isi hanya jika ingin mengganti password.
                    </p>
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        Konfirmasi Password Baru
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi password baru"
                        minlength="8"
                        autocomplete="new-password"
                    >
                </div>

                <div class="actions">
                    <button type="submit" class="btn">
                        💾 Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.customer') }}"
                       class="btn btn-back">
                        ← Kembali
                    </a>
                </div>
            </form>
        </section>

        <footer>
            &copy; {{ date('Y') }} Pengaduan Masyarakat - Admin
        </footer>

    </main>
</body>
</html>
