<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class AdminPengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with('user');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengaduan = $query->latest()->get();

        return view('admin.pengaduan', compact('pengaduan'));
    }

    public function show($id)
    {
        $item = Pengaduan::with('user')->findOrFail($id);

        return view('admin.detail-pengaduan', compact('item'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai',
        ]);

        $item = Pengaduan::findOrFail($id);
        $item->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.pengaduan.detail', $item->id)
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = Pengaduan::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('admin.pengaduan')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
