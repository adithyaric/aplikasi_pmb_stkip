<?php

namespace App\Http\Controllers;

use App\Exports\GelombangDelapanExport;
use App\Exports\GelombangDuaBelasExport;
use App\Exports\GelombangDuaExport;
use App\Exports\GelombangEmpatExport;
use App\Exports\GelombangEnamExport;
use App\Exports\GelombangLimaExport;
use App\Exports\GelombangSatuExport;
use App\Exports\GelombangSebelasExport;
use App\Exports\GelombangSembilanExport;
use App\Exports\GelombangSepuluhExport;
use App\Exports\GelombangTigaExport;
use App\Exports\GelombangTujuhExport;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        return Excel::download(new MahasiswaExport, 'Rekapan.csv');
        // return 'Berhasil';

    }

    public function export4Gelombang()
    {
        return Excel::download(new GelombangSatuExport, 'Rekapan Gelombang 1.csv');
        // return 'Berhasil';

    }

    public function export5Gelombang()
    {
        return Excel::download(new GelombangDuaExport, 'Rekapan Gelombang 2.csv');
        // return 'Berhasil';

    }

    public function export6Gelombang()
    {
        return Excel::download(new GelombangTigaExport, 'Rekapan Gelombang 3.csv');
        // return 'Berhasil';

    }

    public function export7Gelombang()
    {
        return Excel::download(new GelombangEmpatExport, 'Rekapan Gelombang 4.csv');
        // return 'Berhasil';

    }

    public function export8Gelombang()
    {
        return Excel::download(new GelombangLimaExport, 'Rekapan Gelombang 5.csv');
        // return 'Berhasil';

    }

    public function export9Gelombang()
    {
        return Excel::download(new GelombangEnamExport, 'Rekapan Gelombang 6.csv');
        // return 'Berhasil';

    }

    public function export10Gelombang()
    {
        return Excel::download(new GelombangTujuhExport, 'Rekapan Gelombang 1 2024.csv');
        // return 'Berhasil';

    }

    public function export11Gelombang()
    {
        return Excel::download(new GelombangDelapanExport, 'Rekapan Gelombang 2 2024.csv');
        // return 'Berhasil';

    }

    public function export12Gelombang()
    {
        return Excel::download(new GelombangSembilanExport, 'Rekapan Gelombang 3 2024.csv');
        // return 'Berhasil';

    }

    public function export13Gelombang()
    {
        return Excel::download(new GelombangSepuluhExport, 'Rekapan Gelombang 4 2024.csv');
        // return 'Berhasil';

    }

    public function export14Gelombang()
    {
        return Excel::download(new GelombangSebelasExport, 'Rekapan Gelombang 5 2024.csv');
        // return 'Berhasil';

    }

    public function export15Gelombang()
    {
        return Excel::download(new GelombangDuaBelasExport, 'Rekapan Gelombang Khusus 2024.csv');
        // return 'Berhasil';

    }
}
