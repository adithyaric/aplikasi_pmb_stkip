<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GelombangEmpatExport implements FromView
{
    public function view(): View
    {
        return view('admin.excel.cetak', [
            'data' => User::with('mahasiswa')->where('roles', 'MAHASISWA')->where('gelombang_id', 7)->get(),
        ]);
    }
}
