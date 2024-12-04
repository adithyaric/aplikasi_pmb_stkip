<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Penerimaan;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    //
    // public function jalur(Request $request)
    // {
    //     $mahasiswa = collect();

    //     if ($request->jalur) {
    //         $mahasiswa = User::whereHas('mahasiswa', function ($q) use ($request) {
    //             $q->where('jalur', $request->jalur);
    //         })->orderBy('name')->get();
    //     }

    //     return view('admin.report.jalur', compact('mahasiswa'));
    // }

    //
    // public function jalur_pdf(Request $request)
    // {
    //     $mahasiswa = User::whereHas('mahasiswa', function ($q) use ($request) {
    //         $q->where('jalur', $request->jalur);
    //     })->orderBy('name')->get();

    //     $pdf = PDF::loadview('admin.report.jalur_pdf', compact('mahasiswa'));

    //     return $pdf->stream();
    // }

    //
    public function prodi(Request $request)
    {
        $tahuns = Tahun::get();
        $tahunId = $request->input('tahun_id') ?? Tahun::where('status', true)->value('id');
        $jurusan = Jurusan::get();
        $jurusanId = $request->input('jurusan_id');
        $gelombang = Gelombang::get();
        $gelombangId = $request->input('gelombang_id');

        // $mahasiswa = collect();

        // if ($request->jurusan_id) {
        $mahasiswa = User::whereHas('gelombang', function ($query) use ($tahunId) {
            return $query->where('tahun_id', $tahunId);
        })
            ->when($gelombangId, function ($query) use ($gelombangId) {
                return $query->where('gelombang_id', $gelombangId);
            })
            ->when($jurusanId, function ($query) use ($jurusanId) {
                return $query->whereHas('mahasiswa', function ($q) use ($jurusanId) {
                    return $q->where('jurusan_id', $jurusanId);
                });
            })
            ->orderBy('name')->get();
        // }

        return view('admin.report.prodi', compact('jurusan', 'gelombang', 'mahasiswa', 'tahunId', 'tahuns'));
    }

    //
    public function prodi_pdf(Request $request)
    {
        $tahunId = $request->input('tahun_id') ?? Tahun::where('status', true)->value('id');
        $jurusanId = $request->input('jurusan_id');
        $gelombangId = $request->input('gelombang_id');

        $nama_jurusan = Jurusan::findOrFail($request->jurusan_id)->name;

        $mahasiswa = User::whereHas('gelombang', function ($query) use ($tahunId) {
            return $query->where('tahun_id', $tahunId);
        })
            ->when($gelombangId, function ($query) use ($gelombangId) {
                return $query->where('gelombang_id', $gelombangId);
            })
            ->when($jurusanId, function ($query) use ($jurusanId) {
                return $query->whereHas('mahasiswa', function ($q) use ($jurusanId) {
                    return $q->where('jurusan_id', $jurusanId);
                });
            })
            ->orderBy('name')->get();

        $pdf = PDF::loadview('admin.report.prodi_pdf', compact('nama_jurusan', 'mahasiswa'));

        return $pdf->stream();
    }

    //
    public function penerimaan(Request $request)
    {
        $tahuns = Tahun::get();
        $tahunId = $request->input('tahun_id') ?? Tahun::where('status', true)->value('id');
        $gelombang = Gelombang::get();
        $gelombangId = $request->input('gelombang_id');
        $penerimaan = Penerimaan::get();
        $penerimaanId = $request->input('penerimaan_id');

        // $mahasiswa = collect();

        // if ($request->penerimaan_id) {
        $mahasiswa = User::whereHas('gelombang', function ($query) use ($tahunId) {
            return $query->where('tahun_id', $tahunId);
        })
            // ->whereHas('mahasiswa', function ($q) use ($request) {
            //     return $q->where('penerimaan_id', $request->penerimaan_id);
            // })
            ->when($gelombangId, function ($query) use ($gelombangId) {
                return $query->where('gelombang_id', $gelombangId);
            })
            ->when($penerimaanId, function ($query) use ($penerimaanId) {
                return $query->whereHas('mahasiswa', function ($q) use ($penerimaanId) {
                    return $q->where('penerimaan_id', $penerimaanId);
                });
            })
            // ->when($jurusanId, function ($query) use ($jurusanId) {
            //     return $query->whereHas('mahasiswa', function ($q) use ($jurusanId) {
            //         return $q->where('jurusan_id', $jurusanId);
            //     });
            // })
            ->orderBy('name')->get();
        // }

        return view('admin.report.penerimaan', compact('penerimaan', 'gelombang', 'mahasiswa', 'tahunId', 'tahuns'));
    }

    //
    public function penerimaan_pdf(Request $request)
    {
        $tahunId = $request->input('tahun_id') ?? Tahun::where('status', true)->value('id');
        // $jurusanId = $request->input('jurusan_id');
        $gelombangId = $request->input('gelombang_id');
        $penerimaanId = $request->input('penerimaan_id');
        $nama_penerimaan = Penerimaan::findOrFail($request->penerimaan_id)->name;

        // $mahasiswa = collect();

        // if ($request->penerimaan_id) {
        $mahasiswa = User::whereHas('gelombang', function ($query) use ($tahunId) {
            return $query->where('tahun_id', $tahunId);
        })
            // ->whereHas('mahasiswa', function ($q) use ($request) {
            //     return $q->where('penerimaan_id', $request->penerimaan_id);
            // })
            ->when($gelombangId, function ($query) use ($gelombangId) {
                return $query->where('gelombang_id', $gelombangId);
            })
            ->when($penerimaanId, function ($query) use ($penerimaanId) {
                return $query->whereHas('mahasiswa', function ($q) use ($penerimaanId) {
                    return $q->where('penerimaan_id', $penerimaanId);
                });
            })
            // ->when($jurusanId, function ($query) use ($jurusanId) {
            //     return $query->whereHas('mahasiswa', function ($q) use ($jurusanId) {
            //         return $q->where('jurusan_id', $jurusanId);
            //     });
            // })
            ->orderBy('name')->get();

        // }

        $pdf = PDF::loadview('admin.report.penerimaan_pdf', compact('nama_penerimaan', 'mahasiswa'));

        return $pdf->stream();
    }
}
