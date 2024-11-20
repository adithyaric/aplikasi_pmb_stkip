<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Penerimaan;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    //
    public function jalur(Request $request)
    {
        $mahasiswa = collect();

        if ($request->jalur) {
            $mahasiswa = User::whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('jalur', $request->jalur);
            })->orderBy('name')->get();
        }

        return view('admin.report.jalur', compact('mahasiswa'));
    }

    //
    public function jalur_pdf(Request $request)
    {
        $mahasiswa = User::whereHas('mahasiswa', function ($q) use ($request) {
            $q->where('jalur', $request->jalur);
        })->orderBy('name')->get();

        $pdf = PDF::loadview('admin.report.jalur_pdf', compact('mahasiswa'));

        return $pdf->stream();
    }

    //
    public function prodi(Request $request)
    {
        $jurusan = Jurusan::all();

        $mahasiswa = collect();

        if ($request->jurusan_id) {
            $mahasiswa = User::whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('jurusan_id', $request->jurusan_id);
            })->orderBy('name')->get();
        }

        return view('admin.report.prodi', compact('jurusan', 'mahasiswa'));
    }

    //
    public function prodi_pdf(Request $request)
    {
        $nama_jurusan = Jurusan::findOrFail($request->jurusan_id)->name;

        $mahasiswa = User::whereHas('mahasiswa', function ($q) use ($request) {
            $q->where('jurusan_id', $request->jurusan_id);
        })->orderBy('name')->get();

        $pdf = PDF::loadview('admin.report.prodi_pdf', compact('nama_jurusan', 'mahasiswa'));

        return $pdf->stream();
    }

    //
    public function penerimaan(Request $request)
    {
        $penerimaan = Penerimaan::all();

        $mahasiswa = collect();

        if ($request->penerimaan_id) {
            $mahasiswa = User::whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('penerimaan_id', $request->penerimaan_id);
            })->orderBy('name')->get();
        }

        return view('admin.report.penerimaan', compact('penerimaan', 'mahasiswa'));
    }

    //
    public function penerimaan_pdf(Request $request)
    {
        $nama_penerimaan = Penerimaan::findOrFail($request->penerimaan_id)->name;

        $mahasiswa = collect();

        if ($request->penerimaan_id) {
            $mahasiswa = User::whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('penerimaan_id', $request->penerimaan_id);
            })->orderBy('name')->get();
        }

        $pdf = PDF::loadview('admin.report.penerimaan_pdf', compact('nama_penerimaan', 'mahasiswa'));

        return $pdf->stream();
    }
}
