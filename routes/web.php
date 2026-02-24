    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\halamanController;
    use App\Http\Controllers\data_akunController;
    use App\Models\penjual;


    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', function () {
        return view('index');
    });
    Route::get('/tes', function () {
        return view('super_user.produk');
    });

    //menampilkan halaman daftar untuk siswa
    Route::get('/sign-in', [halamanController::class, 'index2'])->name('daftar');
    Route::post('/sign-in', [data_akunController::class, 'register'])->name('fdaftar');

    Route::post('/daftar-nis', [data_akunController::class, 'storeNis'])->name('nis.store');
    Route::delete('/nis/{id}', [data_akunController::class, 'destroyNis'])->name('nis.destroy');

    //menampilkan halaman login untuk siswa
    Route::get('/login', [halamanController::class, 'index3'])->name('login');
    Route::post('/login', [data_akunController::class, 'login'])->name('flogin');
    Route::post('/logout', function () {
        session()->flush();
        return redirect('/login');
    })->name('logout');
    Route::delete('/siswa/{id}', [data_akunController::class, 'destroy'])->name('siswa.destroy');

    Route::get('/login-kantin', [halamanController::class, 'index11'])->name('login.bule');
    Route::post('/daftar-kantin', [data_akunController::class, 'storeKantin'])->name('kantin.store');
    Route::post('/login-kantin', [data_akunController::class, 'loginKantin'])->name('kantin.login');
    Route::delete('/kantin/{id}', [data_akunController::class, 'destroyKantin'])->name('kantin.destroy');
    Route::post('/logout-kantin', function () {
        if (session()->has('kantin_id')) {
            penjual::where('id', session('kantin_id'))
                ->update(['last_seen' => now()->subMinutes(2)]);
        }

        session()->flush();
        return redirect('/');
    })->name('logout.kantin');

    Route::middleware(['ceklogin'])->group(function () {
        //menampilkan halaman index
        Route::get('/pilih-menu', [halamanController::class, 'index1'])->name('index');
        Route::get('/pilih-menu/makanan', [halamanController::class, 'index5'])->name('index.makanan');
        Route::get('/keranjang', [halamanController::class, 'index6'])->name('keranjang.index');
        Route::get('/pilih-menu/minuman', [halamanController::class, 'index7'])->name('index.minuman');
        Route::get('/search', [halamanController::class, 'index8'])->name('search');
        Route::get('/kantin/{id}', [halamanController::class, 'index4'])->name('pilih_kantin');
        Route::get('/profile', [halamanController::class, 'index9'])->name('profile_page');
        Route::get('/kantin-makanan/{id}', [halamanController::class, 'index12'])->name('kantin.makanan');
        Route::get('/kantin-minuman/{id}', [halamanController::class, 'index13'])->name('kantin.minuman');
        Route::get('/riwayat-pembelian', [halamanController::class, 'index14'])->name('riwayat.siswa');
    });

    Route::middleware(['cekkantin', 'update.lastseen'])->group(function () {
        Route::get('/dashboard-kantin', [halamanController::class, 'index15'])->name('dashboard.kantin');
        Route::get('/profile-kantin', [halamanController::class, 'index21'])->name('profile.kantin');
        Route::get('/tambah-menu', [halamanController::class, 'index17'])->name('tambah_menu');
        Route::get('/riwayat', [halamanController::class, 'index16'])->name('dashboard.riwayat');
    });

    Route::middleware(['cekkantin'])->group(function () {
        Route::get('/kantin-order-terbaru', [halamanController::class, 'orderTerbaru'])->name('kantin.orderTerbaru');
    });

    Route::middleware(['cekadmin'])->group(function () {
        // Super user routes
        Route::get('/super_user/index', [halamanController::class, 'index18'])->name('super_user.index');
        Route::get('/super_user/manajemen_kantin', [halamanController::class, 'index20'])->name('super_user.manajemen_kantin');
        Route::get('/super_user/laporan', [halamanController::class, 'index19'])->name('super_user.laporan');
        Route::get('/super_user/siswa', [halamanController::class, 'index22'])->name('super_user.siswa');
        Route::get('/super_user/produk', [halamanController::class, 'index26'])->name('super_user.produk');
        Route::get('/super_user/riwayat_transaksi', [halamanController::class, 'index23'])->name('super_user.riwayat_transaksi'); 
        Route::get('/super_user/data_admin', [halamanController::class, 'index25'])->name('super_user.data_admin');
        Route::get('/daftar-kantin', [halamanController::class, 'index10'])->name('daftar.bule');
        Route::get('/daftar-nis', [halamanController::class, 'index27'])->name('daftar_nis');
    });

    Route::get('/698f33ea-6a68-83a1-978d-3f48491fd0f2', [halamanController::class, 'index24'])->name('super_user.login');
    Route::post('/admin/login', [data_akunController::class, 'loginAdmin'])->name('admin.flogin');

    Route::post('/super_user/admin/store', [data_akunController::class, 'store'])->name('admin.store');

    Route::post('/admin/logout', function () {
        session()->forget('admin_id');
        session()->forget('admin_nama');
        return redirect('/');
    })->name('admin.logout');
    Route::delete('/admin/{id}', [data_akunController::class, 'destroyAdmin'])->name('admin.destroy');

    Route::post('/super_user/kategori', [data_akunController::class, 'storekategori'])->name('kategori.store');
    Route::delete('/kategori/{id}', [data_akunController::class, 'destroykategori'])->name('kategori.destroy');

    Route::post('/tambah-menu', [data_akunController::class, 'storeproduk'])->name('produk.store');

    Route::get('/search-produk', [data_akunController::class, 'searchProduk'])->name('search.produk');
    Route::get('/search', [data_akunController::class, 'indexSearch'])->name('search');

    Route::post('/keranjang/tambah', [data_akunController::class, 'tambahkeranjan'])
        ->name('keranjang.tambah');
    Route::post('/keranjang/update', [data_akunController::class, 'updatekeranjang'])->name('keranjang.update');

    Route::get('/kantin-daftar_menu', [halamanController::class, 'index28'])->name('daftar_menu');
    Route::delete('/kantin/menu/{id}', [data_akunController::class, 'destroyProduk'])->name('kantin.menu.delete');

    Route::get('/riwayat-kantin', [halamanController::class, 'riwayatKantin'])->name('riwayat.kantin');
    Route::put('/transaksi/{id}/proses', [data_akunController::class, 'prosesTransaksi'])->name('transaksi.proses');

    Route::post('/checkout', [data_akunController::class, 'checkout'])
    ->name('checkout');

    Route::put('/kantin/menu/update/{id}',
  [data_akunController::class, 'updateProduk'])
  ->name('kantin.menu.edit');