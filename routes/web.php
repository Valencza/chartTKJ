<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\adminServiceBarangController;
use App\Http\Controllers\AdminservisLayananController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\jasaLayananController;
use App\Http\Controllers\jenisBarangController;
use App\Http\Controllers\jenisKerusakanController;
use App\Http\Controllers\jenisLayananController;
use App\Http\Controllers\kategoriBarangController;
use App\Http\Controllers\kategoriJasaController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\layananController;
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
use App\Models\jenisLayanan;
use App\Models\servisBarangPetugas;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home.index');
})->name('index');

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
Route::get('/invoice/{order_id}', [serviceController::class, 'showInvoice'])->name('serviceBarang.invoice');
Route::get('/payment-callback', [serviceController::class, 'paymentCallback'])->name('serviceBarang.paymentCallback');
Route::get('/invoice/{order_id}/download', [serviceController::class, 'downloadInvoiceServisBarang'])->name('serviceBarang.download');

Route::get('/get-layanan/{layanan_id}', [serviceController::class, 'getJenisLayanan']);
Route::post('/service/store/layanan', [serviceController::class, 'storeServisLayanan'])->name('serviceLayanan.store');



//home.riwayat

Route::get('/riwayat', [RiwayatController::class, 'showPaidOrders'])->name('riwayat');

Route::get('/portofolio', function () {
    return view('home.portofolio');
})->name('portfolio');

Route::get('/detail-portofolio', function () {
    return view('home.detail-portofolio');
})->name('detail-portofolio');


//dashboard

// Route untuk halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk mengambil data pendapatan grafik
Route::get('/api/get-pendapatan-grafik', [DashboardController::class, 'getPendapatanGrafik']);

//dashboard.produk

Route::get('/dashboard/produk', [ProdukController::class, 'index'])->name('produk');
Route::post('/dashboard/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::put('/dashboard/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/dashboard/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

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

//dashboard.order-servis-layanan

Route::get('/dashboard/servis-layanan', [AdminservisLayananController::class, 'index'])->name('orderServisLayanan');
Route::put('/dashboard/servis-layanan/{id}', [AdminservisLayananController::class, 'update'])->name('orderServisLayanan.update');
Route::post('/dashboard/servis-layanan', [AdminservisLayananController::class, 'petugas'])->name('orderServisLayanan.petugas');

//dashboard.portofolio

Route::get('/dashboard/portofolio', [PortofolioController::class, 'index'])->name('portofolio');
Route::post('/dashboard/portofolio/store', [PortofolioController::class, 'store'])->name('portofolio.store');
Route::put('/dashboard/portofolio/{id}', [PortofolioController::class, 'update'])->name('portofolio.update');
Route::delete('/dashboard/portofolio/{id}', [PortofolioController::class, 'destroy'])->name('portofolio.destroy');

//laravelPWA

Route::get('/manifest.json', function () {
    return response()->file(public_path('manifest.json'));
})->name('manifest');

Route::get('/service-worker.js', function () {
    return response()->file(public_path('service-worker.js'));
})->name('service-worker');
