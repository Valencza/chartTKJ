<?php

use App\Http\Controllers\AdminEditRoleController;
use App\Http\Controllers\AdminInformasiTanggalJasaController;
use App\Http\Controllers\AdminNotifikasiProdukController;
use App\Http\Controllers\AdminNotifikasiServisBarangController;
use App\Http\Controllers\AdminNotifikasiServisJasaController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPortofolioController;
use App\Http\Controllers\adminServiceBarangController;
use App\Http\Controllers\AdminServisBarangPetugasController;
use App\Http\Controllers\AdminservisLayananController;
use App\Http\Controllers\AdminServisLayananPetugasController;
use App\Http\Controllers\AdminStokController;
use App\Http\Controllers\AdminUlasanController;
use App\Http\Controllers\AdminUlasanProdukController;
use App\Http\Controllers\AdminUlasanUserController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InformasiTanggalController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\jasaLayananController;
use App\Http\Controllers\jenisBarangController;
use App\Http\Controllers\jenisKerusakanController;
use App\Http\Controllers\jenisLayananController;
use App\Http\Controllers\kategoriBarangController;
use App\Http\Controllers\kategoriJasaController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\layananController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\serviceBarangController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\servisBarangPetugasController;
use App\Http\Controllers\servisLayananController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UlasanUserController;
use App\Models\jenisLayanan;
use App\Models\servisBarangPetugas;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Middleware\CheckRole;

//auth

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('formRegister');
Route::post('/register', [AuthController::class, 'registerUser'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('formLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//auth.goggle

Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//landing

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::post('/show-ulasan-user', [IndexController::class, 'show'])->name('detail.ulasanUser');
Route::post('/ulasan-user', [UlasanUserController::class, 'store'])->name('storeUlasanUser');

Route::get('/notifikasi', [NotifikasiController::class, 'index']);
Route::post('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead']);
Route::post('/notifikasi/read-all', [NotifikasiController::class, 'markAllAsRead']);
Route::put('/notifikasi/disetujui/{id}', [NotifikasiController::class, 'approve']);
Route::put('/notifikasi/change-date/{id}', [NotifikasiController::class, 'changeDate'])->name('notifikasi.change-date');

//home.pembelian

Route::get('/pembelian/{kategori?}', [PembelianController::class, 'index'])->name('pembelian');

//home.cart

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'getCart'])->name('cart.get');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

//home.detail-produk

Route::get('/detail-produk/{slug}', [PembelianController::class, 'show'])->name('detail-produk');
Route::post('/detail-produk/{slug}', [UlasanController::class, 'store'])->name('ulasan.store');

//home.invoiceBarang

Route::get('/invoice-barang', [InvoiceController::class, 'showInvoice'])->name('invoice.barang');
Route::get('/invoice/download/{orderId}', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');

//home.invoiceJasa

// Route::get('/invoice-jasa', function () {
//     return view('home.invoiceJasa');
// })->name('invoiceJasa');

//home.checkout

Route::get('/checkout/{slug}', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::post('/midtrans/callback', [CheckoutController::class, 'callback'])->name('midtrans.callback');

//home.pengaturan-akun

Route::get('/pengaturan-akun', [ProfileController::class, 'formEdit'])->name('pengaturan-akun');
Route::post('/pengaturan-akun', [ProfileController::class, 'update'])->name('pengaturan-akun.update');

//modal.alamat

Route::get('/alamat/get', [AlamatController::class, 'getAlamat'])->name('alamat.get');
Route::post('/alamat', [AlamatController::class, 'store'])->name('alamat.store');

//home.portofolio

Route::get('/portofolio', [PortofolioController::class, 'display'])->name('portfolio');
Route::get('/portofolio/{slug}', [portofolioController::class, 'detailportfolio'])->name('portofolio.detail');

//home.service

// Route::get('/service', [layananController::class, 'index'])->name('service');

Route::get('/service', [serviceController::class, 'index'])->name('service');

Route::get('/get-kerusakan/{barang_id}', [serviceController::class, 'getJenisKerusakan']);
Route::post('/service/store/barang', [serviceController::class, 'storeServisBarang'])->name('serviceBarang.store');
Route::get('/invoice-servis/{order_id}', [serviceController::class, 'showInvoiceServis'])->name('serviceBarang.invoice');
Route::get('/payment-callback-servis', [serviceController::class, 'paymentCallbackServis'])->name('serviceBarang.paymentCallback');
Route::get('/invoice/{order_id}/download', [serviceController::class, 'downloadInvoiceServisBarang'])->name('serviceBarang.download');

Route::get('/get-layanan/{layanan_id}', [serviceController::class, 'getJenisLayanan']);
Route::post('/service/store/layanan', [serviceController::class, 'storeServisLayanan'])->name('serviceLayanan.store');
Route::get('/invoice-layanan/{order_id}', [serviceController::class, 'showInvoiceLayanan'])->name('serviceLayanan.invoice');
Route::get('/payment-callback-layanan', [serviceController::class, 'paymentCallbackLayanan'])->name('serviceLayanan.paymentCallback');
Route::get('/invoice-layanan/{order_id}/download', [serviceController::class, 'downloadInvoiceServisLayanan'])->name('serviceLayanan.download');

//home.portofolio

Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio.index');
Route::get('/portofolio/{slug}', [PortofolioController::class, 'detailportfolio'])->name('portofolio.detail');


//home.riwayat

Route::get('/riwayat', [RiwayatController::class, 'showPaidOrders'])->name('riwayat');
Route::get('/invoice/barang', [RiwayatController::class, 'showInvoiceBarang'])->name('invoice.barang');
Route::get('/invoice/servis/{order_id}', [RiwayatController::class, 'showInvoiceServis'])->name('invoice.servis');
Route::get('/invoice/jasa/{order_id}', [RiwayatController::class, 'showInvoiceJasa'])->name('invoice.jasa');

//dashboard

// Route untuk halaman dashboard
Route::middleware(['auth', 'check.role:admin,petugas'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route untuk mengambil data pendapatan grafik
    Route::get('/api/get-pendapatan-grafik', [DashboardController::class, 'getPendapatanGrafik']);

    Route::get('/api/get-servisproduk-by-date', function (Request $request) {
        $date = Carbon::parse($request->query('date'))->format('Y-m-d');

        if (!$date) {
            return response()->json(['error' => 'Tanggal tidak dikirim'], 400);
        }

        try {
            $data = DB::table('order_items')
                ->whereDate('created_at', $date)
                ->sum('subtotal');

            return response()->json([
                'labels' => [$date],
                'data' => [$data]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });

    Route::get('/api/get-servisbarang-grafik', [DashboardController::class, 'getPendapatanServis']);

    Route::get('/api/get-servisbarang-by-date', function (Request $request) {
        $date = Carbon::parse($request->query('date'))->format('Y-m-d');

        if (!$date) {
            return response()->json(['error' => 'Tanggal tidak dikirim'], 400);
        }

        try {
            $data = DB::table('servis_barang')
                ->whereDate('created_at', $date)
                ->sum('harga');

            return response()->json([
                'labels' => [$date],
                'data' => [$data]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });

    Route::get('/api/get-servislayanan-grafik', [DashboardController::class, 'getPendapatanLayanan']);

    Route::get('/api/get-servislayanan-by-date', function (Request $request) {
        $date = Carbon::parse($request->query('date'))->format('Y-m-d');

        if (!$date) {
            return response()->json(['error' => 'Tanggal tidak dikirim'], 400);
        }

        try {
            $data = DB::table('servis_jasa')
                ->whereDate('created_at', $date)
                ->sum('harga');

            return response()->json([
                'labels' => [$date],
                'data' => [$data]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });

    //dashboard.produk

    Route::get('/dashboard/produk', [ProdukController::class, 'index'])->name('produk');
    Route::post('/dashboard/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/dashboard/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/dashboard/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    //dashboard.produk-stok

    Route::get('/dashboard/stok-produk', [AdminStokController::class, 'index'])->name('stok');
    Route::put('/dashboard/stok-produk/{id}', [AdminStokController::class, 'update'])->name('stok.update');


    Route::get('/get-product/{id}', [ProdukController::class, 'getProduct']);

    //dashboard.kategori-produk

    Route::get('/dashboard/kategori-produk', [KategoriProdukController::class, 'index'])->name('kategoriProduk');
    Route::post('/dashboard/kategori-produk/store', [KategoriProdukController::class, 'store'])->name('kategoriProduk.store');
    Route::put('/dashboard/kategori-produk/{id}', [KategoriProdukController::class, 'update'])->name('kategoriProduk.update');
    Route::delete('/dashboard/kategori-produk/{id}', [KategoriProdukController::class, 'destroy'])->name('kategoriProduk.destroy');

    //dashboard.kategori-service-barang

    Route::get('/dashboard/jenis-barang', [jenisBarangController::class, 'index'])->name('jenisBarang');
    Route::post('/dashboard/jenis-barang/store', [jenisBarangController::class, 'store'])->name('jenisBarang.store');
    Route::put('/dashboard/jenis-barang/{id}', [jenisBarangController::class, 'update'])->name('jenisBarang.update');
    Route::delete('/dashboard/jenis-barang/{id}', [jenisBarangController::class, 'destroy'])->name('jenisBarang.destroy');

    //dashboard.kategori-service-jasa

    Route::get('/dashboard/kategori-jasa', [kategoriJasaController::class, 'index'])->name('kategoriJasa');
    Route::post('/dashboard/kategori-jasa/store', [kategoriJasaController::class, 'store'])->name('kategoriJasa.store');
    Route::put('/dashboard/kategori-jasa/{id}', [kategoriJasaController::class, 'update'])->name('kategoriJasa.update');
    Route::delete('/dashboard/kategori-jasa/{id}', [kategoriJasaController::class, 'destroy'])->name('kategoriJasa.destroy');

    //dashboard.jenis-layanan

    Route::get('/dashboard/jenis-layanan', [jenisLayananController::class, 'index'])->name('jenisLayanan');
    Route::post('/dashboard/jenis-layanan/store', [jenisLayananController::class, 'store'])->name('jenisLayanan.store');
    Route::put('/dashboard/jenis-layanan/{id}', [jenisLayananController::class, 'update'])->name('jenisLayanan.update');
    Route::delete('/dashboard/jenis-layanan/{id}', [jenisLayananController::class, 'destroy'])->name('jenisLayanan.destroy');

    //dashboard.jasa-kerusakan-barang

    Route::get('/dashboard/jenis-kerusakan', [jenisKerusakanController::class, 'index'])->name('jenisKerusakan');
    Route::post('/dashboard/jenis-kerusakan/store', [jenisKerusakanController::class, 'store'])->name('jenisKerusakan.store');
    Route::put('/dashboard/jenis-kerusakan/{id}', [jenisKerusakanController::class, 'update'])->name('jenisKerusakan.update');
    Route::delete('/dashboard/jenis-kerusakan/{id}', [jenisKerusakanController::class, 'destroy'])->name('jenisKerusakan.destroy');

    //dashboard.order-produk

    Route::get('/order', [AdminOrderController::class, 'index'])->name('order');
    Route::put('/order/{id}', [AdminOrderController::class, 'update'])->name('order.update');

    //dashboard.order-servis-barang

    Route::get('/order-servis-barang', [adminServiceBarangController::class, 'index'])->name('orderServisBarang');
    Route::put('/order-servis-barang/{id}', [adminServiceBarangController::class, 'update'])->name('orderServisBarang.update');
    Route::post('/order-servis-barang', [adminServiceBarangController::class, 'petugas'])->name('orderServisBarang.petugas');

    //dashboard.servis-barang-petugas

    Route::get('/order-servis-barang-petugas', [AdminServisBarangPetugasController::class, 'index'])->name('servisBarangPetugas');
    Route::put('/order-servis-barang-petugas/{id}', [AdminServisBarangPetugasController::class, 'update'])->name('servisBarangPetugas.update');

    //dashboard.servis-layanan-petugas

    Route::get('/order-servis-layanan-petugas', [AdminServisLayananPetugasController::class, 'index'])->name('servisLayananPetugas');
    Route::put('/order-servis-layanan-petugas/{id}', [AdminServisLayananPetugasController::class, 'update'])->name('servisLayananPetugas.update');

    //dashboard.order-servis-layanan

    Route::get('/dashboard/servis-layanan', [AdminservisLayananController::class, 'index'])->name('orderServisLayanan');
    Route::put('/dashboard/servis-layanan/{id}', [AdminservisLayananController::class, 'update'])->name('orderServisLayanan.update');
    Route::post('/dashboard/servis-layanan', [AdminservisLayananController::class, 'petugas'])->name('orderServisLayanan.petugas');
    Route::put('/dashboard/servis-layanan/update-tanggal/{id}', [AdminservisLayananController::class, 'updateTanggal'])->name('servis-jasa.update-tanggal');

    //dashboard.informasi-tanggal

    Route::prefix('dashboard/informasi-tanggal')->controller(InformasiTanggalController::class)->group(function () {
        Route::get('/', 'index')->name('informasi-tanggal.index'); // Ganti dari 'informasiTanggal' ke 'index'
        Route::put('/terima/{id}', 'updateDiterima')->name('informasi-tanggal.terima'); // Sesuai method di controller
        Route::put('/serahkan/{id}', 'updateDiserahkan')->name('informasi-tanggal.serahkan'); // Sesuai method di controller
    });

    //dashboard.informasi-tanggal-jasa

    Route::prefix('dashboard/informasi-tanggal-jasa')->controller(AdminInformasiTanggalJasaController::class)->group(function () {
        Route::get('/', 'index')->name('informasi-tanggal-jasa.index'); // Ganti dari 'informasiTanggal' ke 'index'
    });



    //dashboard.portofolio

    Route::get('/dashboard/portofolio', [PortofolioController::class, 'index'])->name('portofolio');
    Route::post('/dashboard/portofolio/store', [PortofolioController::class, 'store'])->name('portofolio.store');
    Route::put('/dashboard/portofolio/{id}', [PortofolioController::class, 'update'])->name('portofolio.update');
    Route::delete('/dashboard/portofolio/{id}', [PortofolioController::class, 'destroy'])->name('portofolio.destroy');

    //dashboard.user-role

    Route::get('/dashboard/user', [AdminEditRoleController::class, 'index'])->name('user');
    Route::put('/dashboard/user/{id}', [AdminEditRoleController::class, 'update'])->name('user.update');

    //dashboard.ulasan-produk

    Route::get('/dashboard/ulasan-produk', [AdminUlasanProdukController::class, 'index'])->name('ulasan');
    Route::delete('/dashboard/ulasan-produk/{id}', [AdminUlasanProdukController::class, 'destroy'])->name('ulasan.destroy');

    //dashboard.ulasan-pengguna

    Route::get('/dashboard/ulasan-pengguna', [AdminUlasanUserController::class, 'index'])->name('ulasanUser');
    Route::delete('/dashboard/ulasan-pengguna/{id}', [AdminUlasanUserController::class, 'destroy'])->name('ulasanUser.destroy');

    //dashboard.portofolio

    Route::get('/dashboard/portofolio', [AdminPortofolioController::class, 'index'])->name('portofolio');
    Route::post('/dashboard/portofolio/store', [AdminPortofolioController::class, 'store'])->name('portofolio.store');
    Route::put('/dashboard/portofolio/{id}', [AdminPortofolioController::class, 'update'])->name('portofolio.update');
    Route::delete('/dashboard/portofolio/{id}', [AdminPortofolioController::class, 'destroy'])->name('portofolio.destroy');

    //dashboard.notifikasi-produk

    Route::get('/dashboard/notifikasi/produk', [AdminNotifikasiProdukController::class, 'index'])->name('notifikasi.produk');

    //dashboard.notifikasi-servis-barang

    Route::get('/dashboard/notifikasi/servis-barang', [AdminNotifikasiServisBarangController::class, 'index'])->name('notifikasi.servisBarang');

    //dashboard.notifikasi-servis-jasa

    Route::get('/dashboard/notifikasi/servis-layanan', [AdminNotifikasiServisJasaController::class, 'index'])->name('notifikasi.servisJasa');
    Route::put('/dashboard/notifikasi/servis-layanan/update-tanggal/{id}', [AdminNotifikasiServisJasaController::class, 'updateTanggal'])->name('notifikasi.servis-jasa.update-tanggal');
});

//laravelPWA

Route::get('/manifest.json', function () {
    return response()->file(public_path('manifest.json'));
})->name('manifest');

Route::get('/service-worker.js', function () {
    return response()->file(public_path('service-worker.js'));
})->name('service-worker');
