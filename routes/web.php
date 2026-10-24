
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AdminPengaduanController;
use App\Http\Controllers\Admin\CustomerController;
use App\Models\User;
use App\Models\Pengaduan;

// ==================== HALAMAN UTAMA ====================

Route::get('/', function () {
    return redirect()->route('login');
});

// ==================== LOGIN ====================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

// ==================== REGISTER ====================

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

// ==================== ROUTE LOGIN ====================

Route::middleware('auth')->group(function () {

    // ==================== DASHBOARD UMUM ====================

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ==================== DASHBOARD CUSTOMER ====================

    Route::get('/customer/dashboard', function () {
        abort_unless(auth()->user()->role === 'customer', 403);

        $query = Pengaduan::where('user_id', auth()->id());

        $totalPengaduan = (clone $query)->count();

        $menunggu = (clone $query)
            ->where('status', 'menunggu')
            ->count();

        $diproses = (clone $query)
            ->where('status', 'diproses')
            ->count();

        $selesai = (clone $query)
            ->where('status', 'selesai')
            ->count();

        return view('customer.dashboard', compact(
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai'
        ));
    })->name('customer.dashboard');


    // ==================== CRUD DATA CUSTOMER ADMIN ====================

    // READ: Menampilkan dan mencari data customer
    Route::get('/admin/customer', function (Request $request) {
        abort_unless(auth()->user()->role === 'admin', 403);

        return app(CustomerController::class)->index($request);
    })->name('admin.customer');


    // CREATE: Form tambah customer
    Route::get('/admin/customer/create', function () {
        abort_unless(auth()->user()->role === 'admin', 403);

        return app(CustomerController::class)->create();
    })->name('admin.customer.create');


    // CREATE: Menyimpan customer baru
    Route::post('/admin/customer', function (Request $request) {
        abort_unless(auth()->user()->role === 'admin', 403);

        return app(CustomerController::class)->store($request);
    })->name('admin.customer.store');


    // UPDATE: Form edit customer
    Route::get('/admin/customer/{customer}/edit', function ($customer) {
        abort_unless(auth()->user()->role === 'admin', 403);

        $user = User::where('role', 'customer')
            ->findOrFail($customer);

        return app(CustomerController::class)->edit($user);
    })->whereNumber('customer')
      ->name('admin.customer.edit');


    // UPDATE: Menyimpan perubahan customer
    Route::put('/admin/customer/{customer}', function (
        Request $request,
        $customer
    ) {
        abort_unless(auth()->user()->role === 'admin', 403);

        $user = User::where('role', 'customer')
            ->findOrFail($customer);

        return app(CustomerController::class)->update($request, $user);
    })->whereNumber('customer')
      ->name('admin.customer.update');


    // DELETE: Menghapus customer
    Route::delete('/admin/customer/{customer}', function ($customer) {
        abort_unless(auth()->user()->role === 'admin', 403);

        $user = User::where('role', 'customer')
            ->findOrFail($customer);

        return app(CustomerController::class)->destroy($user);
    })->whereNumber('customer')
      ->name('admin.customer.destroy');


    // ==================== PENGELOLAAN PENGADUAN CUSTOMER ====================

    Route::prefix('customer')
        ->name('customer.')
        ->group(function () {

            Route::get('/', [PengaduanController::class, 'index'])
                ->name('index');

            Route::get('/create', [PengaduanController::class, 'create'])
                ->name('create');

            Route::post('/', [PengaduanController::class, 'store'])
                ->name('store');

            Route::get('/{id}', [PengaduanController::class, 'show'])
                ->whereNumber('id')
                ->name('show');

            Route::delete('/{id}', [PengaduanController::class, 'destroy'])
                ->whereNumber('id')
                ->name('destroy');
        });


    // ==================== DASHBOARD ADMIN ====================

    Route::get('/admin/dashboard', function () {
        abort_unless(auth()->user()->role === 'admin', 403);

        $totalPengaduan = Pengaduan::count();

        $menunggu = Pengaduan::where('status', 'menunggu')->count();

        $diproses = Pengaduan::where('status', 'diproses')->count();

        $selesai = Pengaduan::where('status', 'selesai')->count();

        return view('admin.dashboard', compact(
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai'
        ));
    })->name('admin.dashboard');


    // ==================== DAFTAR PENGADUAN ADMIN ====================

    Route::get('/admin/pengaduan', function (Request $request) {
        abort_unless(auth()->user()->role === 'admin', 403);

        return app(AdminPengaduanController::class)->index($request);
    })->name('admin.pengaduan');


    // ==================== DETAIL PENGADUAN ADMIN ====================

    Route::get('/admin/pengaduan/{id}', function ($id) {
        abort_unless(auth()->user()->role === 'admin', 403);

        return app(AdminPengaduanController::class)->show($id);
    })->whereNumber('id')
      ->name('admin.pengaduan.detail');


    // ==================== UBAH STATUS PENGADUAN ====================

    Route::patch('/admin/pengaduan/{id}/status', function (
        Request $request,
        $id
    ) {
        abort_unless(auth()->user()->role === 'admin', 403);

        return app(AdminPengaduanController::class)
            ->updateStatus($request, $id);
    })->whereNumber('id')
      ->name('admin.pengaduan.status');


    // ==================== HAPUS PENGADUAN ADMIN ====================

    Route::delete('/admin/pengaduan/{id}', function ($id) {
        abort_unless(auth()->user()->role === 'admin', 403);

        return app(AdminPengaduanController::class)->destroy($id);
    })->whereNumber('id')
      ->name('admin.pengaduan.destroy');


    // ==================== LOGOUT ====================

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});
