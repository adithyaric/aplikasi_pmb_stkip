<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        $gelombangId = $request->gelombang_id;

        return Excel::download(new MahasiswaExport($gelombangId), 'Rekapan.xlsx');
    }
}
