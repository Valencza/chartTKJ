<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\kategoriBarangController;
use App\Http\Controllers\kategoriJasaController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UlasanController;
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

Route::get('/invoice-jasa', function () {
    return view('home.invoiceJasa');
})->name('invoiceJasa');

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

Route::get('/service', function () {
    return view('home.service');
})->name('service');

//home.riwayat

Route::get('/riwayat', [RiwayatController::class, 'showPaidOrders'])->name('riwayat');

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

Route::get('/dashboard/kategori-barang', [kategoriBarangController::class, 'index'])->name('kategoriBarang');
Route::post('/dashboard/kategori-barang/store', [kategoriBarangController::class, 'store'])->name('kategoriBarang.store');
Route::put('/dashboard/kategori-barang/{id}', [kategoriBarangController::class, 'update'])->name('kategoriBarang.update');
Route::delete('/dashboard/kategori-barang/{id}', [kategoriBarangController::class, 'destroy'])->name('kategoriBarang.destroy');

//dashboard.kategori-service-jasa

Route::get('/dashboard/kategori-jasa', [kategoriJasaController::class, 'index'])->name('kategoriJasa');
Route::post('/dashboard/kategori-jasa/store', [kategoriJasaController::class, 'store'])->name('kategoriJasa.store');
Route::put('/dashboard/kategori-jasa/{id}', [kategoriJasaController::class, 'update'])->name('kategoriJasa.update');
Route::delete('/dashboard/kategori-jasa/{id}', [kategoriJasaController::class, 'destroy'])->name('kategoriJasa.destroy');

//dashboard.order

Route::get('/order', [AdminOrderController::class, 'index'])->name('order');
Route::put('/order/{id}', [AdminOrderController::class, 'update'])->name('order.update');

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
