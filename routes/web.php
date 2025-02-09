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
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PersyaratanController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\WebSettingController;
use App\Models\Gelombang;
use App\Models\Penerimaan;
use App\Models\Video;
use App\Models\WebSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $video = Video::latest()->first();
    $gelombangs = Gelombang::all()->where('status', true);
    $webSetting = WebSetting::first();
    $currentTime = Carbon::now();

    $isOpen = $webSetting && $webSetting->start_at <= $currentTime && $webSetting->end_at >= $currentTime;

    return view('homePage', compact('video', 'gelombangs', 'isOpen'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')
    ->middleware('auth', 'admin')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('tahun', TahunController::class, ['as' => 'admin']);
        Route::resource('pengumuman', AnnouncementController::class, ['as' => 'admin']);
        Route::resource('setting', WebSettingController::class, ['as' => 'admin']);
        Route::resource('mahasiswa', MahasiswaController::class, ['as' => 'admin']);
        Route::resource('jurusan', JurusanController::class, ['as' => 'admin']);
        Route::resource('kelas', KelasController::class, ['as' => 'admin']);
        Route::resource('persyaratan', PersyaratanController::class, ['as' => 'admin']);
        Route::resource('penerimaan', PenerimnaanController::class, ['as' => 'admin']);
        Route::resource('video', VideoController::class, ['as' => 'admin']);
        Route::resource('transaction', TransactionController::class, ['as' => 'admin']);
        Route::put('transaction-bulk', [TransactionController::class, 'bulkUpdate'])->name('transaction.bulkUpdate');
        Route::resource('gelombang', GelombangController::class, ['as' => 'admin']);
        Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('profile/{id}', [DashboardController::class, 'profileUpdate'])->name('profile.update');
        //
        // Route::get('/report/jalur', [ReportController::class, 'jalur'])->name('admin.report.jalur');
        Route::get('/report/prodi', [ReportController::class, 'prodi'])->name('admin.report.prodi');
        Route::get('/report/penerimaan', [ReportController::class, 'penerimaan'])->name('admin.report.penerimaan');
        //
        // Route::get('/report/jalur-pdf', [ReportController::class, 'jalur_pdf'])->name('admin.report.jalur_pdf');
        Route::get('/report/prodi-pdf', [ReportController::class, 'prodi_pdf'])->name('admin.report.prodi_pdf');
        Route::get('/report/penerimaan-pdf', [ReportController::class, 'penerimaan_pdf'])->name('admin.report.penerimaan_pdf');
        //
        Route::get('/all-excel', [ExportController::class, 'index'])->name('admin.excel.cetak');        //
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

Route::get('/get-persyaratan', function (Request $request) {
    $persyaratan = Penerimaan::find($request->id)->persyaratan;

    return response()->json(['persyaratan' => $persyaratan]);
});

Auth::routes(['register' => false]);
