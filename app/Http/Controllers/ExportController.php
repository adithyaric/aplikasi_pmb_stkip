<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Models\Gelombang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        $gelombangId = $request->gelombang_id;
        $gelombang = Gelombang::find($request->gelombang_id);
        $name = 'Rekapan '.$gelombang->nama.'.csv';

        return Excel::download(new MahasiswaExport($gelombangId), $name);
    }
}
