<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MahasiswaExport implements FromView
{
    protected $gelombangId;

    public function __construct($gelombangId = null)
    {
        $this->gelombangId = $gelombangId;
    }

    public function view(): View
    {
        $data = User::where('roles', 'MAHASISWA')
            ->when($this->gelombangId, function ($query) {
                $query->where('gelombang_id', $this->gelombangId);
            })
            ->get();

        return view('admin.excel.cetak', compact('data'));
    }
}
