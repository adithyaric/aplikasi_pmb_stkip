<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormulirController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\PenerimnaanController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\GelombangController;
use App\Http\Controllers\WebSettingController;
use App\Models\Gelombang;
use App\Models\Transaction;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

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
    // $transaction= Transaction::first();
    // return view('pageSuccess',compact('transaction'));
    $video = Video::latest()->first();
    $gelombangs = Gelombang::all()->where('status', '1');

    // ddd();
    return view('homePage', compact('video', 'gelombangs'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')
    ->middleware('auth', 'admin')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('pengumuman', AnnouncementController::class, ['as' => 'admin']);
        Route::resource('setting', WebSettingController::class, ['as' => 'admin']);
        Route::resource('mahasiswa', MahasiswaController::class, ['as' => 'admin']);
        Route::resource('jurusan', JurusanController::class, ['as' => 'admin']);
        Route::resource('penerimaan', PenerimnaanController::class, ['as' => 'admin']);
        Route::resource('video', VideoController::class, ['as' => 'admin']);
        Route::resource('transaction', TransactionController::class, ['as' => 'admin']);
        Route::put('transaction-bulk', [TransactionController::class, 'bulkUpdate'])->name('transaction.bulkUpdate');
        Route::resource('gelombang', GelombangController::class, ['as' => 'admin']);
        Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('profile/{id}', [DashboardController::class, 'profileUpdate'])->name('profile.update');
        //
        Route::get('/report/jalur', [ReportController::class, 'jalur'])->name('admin.report.jalur');
        Route::get('/report/prodi', [ReportController::class, 'prodi'])->name('admin.report.prodi');
        Route::get('/report/penerimaan', [ReportController::class, 'penerimaan'])->name('admin.report.penerimaan');
        //
        Route::get('/report/jalur-pdf', [ReportController::class, 'jalur_pdf'])->name('admin.report.jalur_pdf');
        Route::get('/report/prodi-pdf', [ReportController::class, 'prodi_pdf'])->name('admin.report.prodi_pdf');
        Route::get('/report/penerimaan-pdf', [ReportController::class, 'penerimaan_pdf'])->name('admin.report.penerimaan_pdf');
        //
        Route::get('/all-excel', [ExportController::class, 'index'])->name('admin.excel.cetak');
        Route::get('/gel-4excel', [ExportController::class, 'export4Gelombang']);
        Route::get('/gel-5excel', [ExportController::class, 'export5Gelombang']);
        Route::get('/gel-6excel', [ExportController::class, 'export6Gelombang']);
        Route::get('/gel-7excel', [ExportController::class, 'export7Gelombang']);
        Route::get('/gel-8excel', [ExportController::class, 'export8Gelombang']);
        Route::get('/gel-9excel', [ExportController::class, 'export9Gelombang']);
        Route::get('/gel-10excel', [ExportController::class, 'export10Gelombang']);
        Route::get('/gel-11excel', [ExportController::class, 'export11Gelombang']);
        Route::get('/gel-12excel', [ExportController::class, 'export12Gelombang']);
        Route::get('/gel-13excel', [ExportController::class, 'export13Gelombang']);
        Route::get('/gel-14excel', [ExportController::class, 'export14Gelombang']);
        Route::get('/gel-15excel', [ExportController::class, 'export15Gelombang']);
        //
        Route::get('/mahasiswa/gelombang', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.gelombang');
    });
Route::prefix('mahasiswa')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [MahasiswaController::class, 'dashboard'])->name('dashboard.mahasiswa');
        Route::get('/data', [FormulirController::class, 'data']);
        Route::get('/data-edit/{id}', [FormulirController::class, 'edit'])->name('edit-attachment');
        Route::post('/data', [FormulirController::class, 'updateData'])->name('mahasiswa.update.data');
        Route::get('/biodata', [FormulirController::class, 'biodata'])->name('biodata.index');
        Route::post('/biodata', [FormulirController::class, 'biostore'])->name('mahasiswa.create.biodata');
        Route::get('/uploads', [FormulirController::class, 'uploads']);
        Route::get('/cetak', [FormulirController::class, 'cetakPdf']);
        Route::get('/profile', [FormulirController::class, 'Profile'])->name('profile.mahasiswa');
        Route::PUT('/profile-update/{id}', [FormulirController::class, 'UpdateProfile'])->name('update.profile.mahasiswa');
        Route::POST('/cetakPDF', [FormulirController::class, 'PrintPdf'])->name('PrintPDF');
        Route::POST('/changePhoto', [MahasiswaController::class, 'changePhoto'])->name('changePhoto');
    });
Route::post('/register-mahasiswa', [MahasiswaController::class, 'RegisterMahasiwa'])->name('register.mahasiswa');

Auth::routes(['register' => false]);
