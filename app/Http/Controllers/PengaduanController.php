<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // Menampilkan riwayat pengaduan customer
    public function index()
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.index', compact('pengaduan'));
    }

    // Menampilkan form buat pengaduan
    public function create()
    {
        return view('customer.create');
    }

    // Menyimpan pengaduan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required|string',
            'foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'user_id'           => Auth::id(),
            'judul'             => $request->judul,
            'isi'               => $request->isi,
            'tanggal_pengaduan' => now()->toDateString(),
            'status'            => 'menunggu',
        ];

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('pengaduan', 'public');
        }

        Pengaduan::create($data);

        return redirect()
            ->route('customer.index')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }

    // Menampilkan detail pengaduan
    public function show($id)
    {
        $item = Pengaduan::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('customer.show', compact('item'));
    }

    // Menghapus pengaduan
    public function destroy($id)
    {
        $item = Pengaduan::where('user_id', Auth::id())
            ->findOrFail($id);

        // Hapus foto dari storage jika tersedia
        if ($item->foto) {
            Storage::disk('public')->delete($item->foto);
        }

        $item->delete();

        return redirect()
            ->route('customer.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
