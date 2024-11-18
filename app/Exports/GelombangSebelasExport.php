<?php

namespace App\Exports;

use App\Models\Attachments;
use App\Models\Biodata;
use App\Models\Alamat;
use App\Models\Lulusan;
use App\Models\PemilikKartu;
use App\Models\Rencana;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Penerimaan;
use App\Models\Gelombang;
use App\Models\User;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class GelombangSebelasExport implements FromView
{
    public function view(): View
    {
        return view('admin.excel.cetak', [
            'data' => User::with('mahasiswa')->where('roles', 'MAHASISWA')->where('gelombang_id', 14)->get()
            ]);
    }
}
