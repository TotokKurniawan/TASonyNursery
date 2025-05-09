<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DesignAdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NegosiasiController;
use App\Http\Controllers\PelangganAdminController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranAdminController;
use App\Http\Controllers\PesananAdminController;
use App\Http\Controllers\PesananUserController;
use App\Http\Controllers\PesananUserController2;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;

use Illuminate\Support\Facades\Route;



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [LandingController::class, 'landingpage'])->name('home');
Route::get('/about', [LandingController::class, 'About'])->name('about');
Route::get('/service', [LandingController::class, 'service'])->name('service');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');

Route::get('/register', action: [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', action: [RegisterController::class, 'storeRegister'])->name('storeregister');

Route::get('/ForgotPassword', [ForgotPasswordController::class, 'forgotpassword'])->name(name: 'forgotpassword');
Route::post('/update-password', [ForgotPasswordController::class, 'updatePassword'])->name('update-password');

Route::get('/homeUser', [UserController::class, 'homePage'])->name('homeuser');
Route::get('/aboutUser', [UserController::class, 'Aboutuser'])->name('aboutuser');
Route::get('/serviceUser', [UserController::class, 'serviceuser'])->name(name: 'serviceUser');
Route::get('/pesananUser', [UserController::class, 'pesananuser'])->name('pesananUser');
Route::get('/profileUser', [UserController::class, 'ProfileUser'])->name('profileUser');
Route::get('/contactUser', [UserController::class, 'contactuser'])->name(name: 'contactUser');

Route::get('/TambahPesan', [UserController::class, 'TambahPesan'])->name('TambahPesan1');
Route::post('/TambahPelanggan/storeUser', [PesananUserController::class, 'storepelangganuser'])->name('storeuser');
Route::get('/pesan2/{id_pelanggan}', [PesananUserController::class, 'Pesanan2'])->name('pesan2');
Route::post('/pesanan/store', action: [PesananUserController::class, 'store'])->name('pesanan.store2');
Route::patch('/pesanan/{id}/tolak', [PesananUserController::class, 'tolak'])->name('pesanan.tolak');

Route::get('/TambahPesan3', [UserController::class, 'TambahPesan3'])->name('TambahPesan3');
Route::post('/TambahPelanggan/storeuserbydesign', [PesananUserController2::class, 'storeuserbydesign'])->name('storeuserbydesign');
Route::get('/pesan4/{id_pelanggan}', [PesananUserController2::class, 'Pesanan4'])->name('pesan4');
Route::post('/pesanan/{id_pelanggan}/store', [PesananUserController2::class, 'storePesanan2'])->name('pesanan.store');


Route::get('/Dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('/Pelanggan', [AdminController::class, 'pelanggan'])->name('pelanggan');
Route::delete('/Pelanggan/{pelanggan}', [PelangganAdminController::class, 'deletepelanggan'])->name('deletepelanggan');
Route::get('/Pesanan', [PesananAdminController::class, 'pesanan'])->name('pesanan');
Route::patch('/admin/tolak/{id}', action: [PesananAdminController::class, 'tolakadmin'])->name('tolakadmin');
Route::patch('/admin/terima/{id}', [PesananAdminController::class, 'terimaadmin'])->name('terimaadmin');
Route::patch('/admin/terimalunas/{id}', [PesananAdminController::class, 'terimalunas'])->name('terimalunas');
Route::patch('/admin/lanjut/{id}', [PesananAdminController::class, 'lanjutadmin'])->name(name: 'lanjutadmin');

Route::patch('/admin/selesai/{id}', [PesananAdminController::class, 'selesaiadmin'])->name(name: 'selesaiadmin');
Route::patch('/pesanan/{id}', [PesananAdminController::class, 'update'])->name('pesanan.update');
Route::patch('/pesananuser/{id}', [UserController::class, 'update'])->name('pesanan.update');


Route::patch('/pesanan/metode-pembayaran/{id}', [PesananAdminController::class, 'updateMetodePembayaran'])->name('updateMetodePembayaran');
Route::get('/Pengeluaran', [AdminController::class, 'pengeluaran'])->name('pengeluaran');
Route::get('/TambahPengeluaran', [AdminController::class, 'tambahpengeluaran'])->name('tambahpengeluaran');
Route::post('/TambahPengeluaran/store', [PengeluaranAdminController::class, 'store'])->name('storepengeluaran');
Route::put('/pengeluaran/{id}', [PengeluaranAdminController::class, 'updatepengeluaran'])->name('pengeluaran.update');
Route::delete('/Pengeluaran/{pengeluaran}', [PengeluaranAdminController::class, 'deletepengeluaran'])->name('deletepengeluaran');

Route::get('/Design', [AdminController::class, 'Design'])->name('design');
Route::get('/TambahDesign', [AdminController::class, 'TambahDesain'])->name('tambahdesign');
Route::post('/FormTambahDesign', [DesignAdminController::class, 'store'])->name('design.store');
Route::put('/design/update/{id}', [DesignAdminController::class, 'updatedesign'])->name('updatedesign');
Route::delete('/Design/{desain}', [DesignAdminController::class, 'deletedesign'])->name('deletedesign');

Route::get('/laporan', [LaporanController::class, 'Laporan'])->name('laporan');
Route::post('/laporan/cetak', [LaporanController::class, 'cetakPengeluaran'])->name('laporan.cetak');
Route::post('/laporan-pendapatan', [LaporanController::class, 'cetakPendapatan'])->name('cetakpendapatan');

Route::get('/Profile', [AdminController::class, 'profile'])->name('profile');
Route::post('/update-profile', [ProfileController::class, 'update'])->name('update.profile');

Route::get('/pembayaran-bank/{id}', [PembayaranController::class, 'showPembayaranBank'])->name('halamanPembayaranBank');
Route::get('/cetak-pesanan/{id}', [PesananAdminController::class, 'cetakPesanan2'])->name('cetakPesanan');

Route::post('/payment/initiate/{id}', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');

Route::get('/Pesan', [AdminController::class, 'pesan'])->name('pesan');

Route::get('/admin/messages/{customerId}', [ChatController::class, 'getMessages']);
Route::post('/admin/messages/send', action: [ChatController::class, 'sendMessage']);

Route::get('/user/messages', action: [ChatController::class, 'getUserMessages']); // Lihat pesan
Route::post('/user/send-message', [ChatController::class, 'sendUserMessage']); // Kirim pesan

Route::post('/payment/update-status/{id}', [PaymentController::class, 'updatePaymentStatus']);

Route::get('/lanjutpesan', function (\Illuminate\Http\Request $request) {
    $id_pelanggan = $request->input('id_pelanggan');
    return redirect()->route('pesan2', ['id_pelanggan' => $id_pelanggan]);
})->name('lanjut.pesan');

Route::get('/lanjutpesan2', function (\Illuminate\Http\Request $request) {
    $id_pelanggan = $request->input('id_pelanggan');
    return redirect()->route('pesan4', ['id_pelanggan' => $id_pelanggan]);
})->name('lanjut.pesan2');



Route::post('/negosiasi', [NegosiasiController::class, 'store'])->name('negosiasi.store');
Route::post('/user/negosiasi/kirim', [NegosiasiController::class, 'kirimUser'])->name('user.negosiasi.kirim');
Route::post('/upload-bukti/{pesananId}', [PaymentController::class, 'uploadBukti'])->name('upload.bukti');
