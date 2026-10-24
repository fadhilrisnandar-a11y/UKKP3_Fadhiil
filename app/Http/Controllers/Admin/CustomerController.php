<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // READ: Menampilkan dan mencari data user
    public function index(Request $request)
    {
        $users = User::where('role', 'customer')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.customer', compact('users'));
    }

    // FORM TAMBAH USER
    public function create()
    {
        return view('admin.customer.create');
    }

    // CREATE: Menyimpan user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);

        return redirect()
            ->route('admin.customer')
            ->with('success', 'User berhasil ditambahkan.');
    }

    // FORM EDIT USER
    public function edit(User $customer)
    {
        abort_unless($customer->role === 'customer', 404);

        return view('admin.customer.edit', compact('customer'));
    }

    // UPDATE: Memperbarui data user
    public function update(Request $request, User $customer)
    {
        abort_unless($customer->role === 'customer', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($customer->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $customer->name = $validated['name'];
        $customer->email = $validated['email'];

        if (!empty($validated['password'])) {
            $customer->password = Hash::make($validated['password']);
        }

        $customer->save();

        return redirect()
            ->route('admin.customer')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    // DELETE: Menghapus user
    public function destroy(User $customer)
    {
        abort_unless($customer->role === 'customer', 404);

        $customer->delete();

        return redirect()
            ->route('admin.customer')
            ->with('success', 'User berhasil dihapus.');
    }
}
