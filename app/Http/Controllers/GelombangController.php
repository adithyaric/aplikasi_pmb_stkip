<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GelombangController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $gelombang = Gelombang::with('tahun')->latest()->get();

            return DataTables::of($gelombang)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="javascript:void(0)" onClick="Edit(this.id)" id="'.$data->id.'" class="edit btn btn-success btn-sm">Edit</a>
                        <a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                })
                ->addColumn('nominal', function ($data) {
                    return moneyFormat($data->nominal);
                })
                ->addColumn('status', function ($data) {
                    return $data->status == 1 ? 'Aktif' : 'Tidak Aktif';
                })
                ->addColumn('tahun_status', function ($data) {
                    return $data->tahun ? ($data->tahun->status == 1 ? 'Aktif' : 'Tidak Aktif') : '-';
                })
                ->addColumn('tahun_name', function ($data) {
                    return $data->tahun ? $data->tahun->nama : '-';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.gelombang.index', [
            'tahuns' => Tahun::get(),
        ]);
    }

    public function store(Request $request)
    {
        Gelombang::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'nama' => $request->nama,
                'nominal' => $request->nominal,
                'status' => $request->status,
                'tahun_id' => $request->tahun_id,
            ],
        );

        return redirect()->route('admin.gelombang.index')->with('success', 'data berhasil disimpan');
    }

    public function show(Gelombang $gelombang)
    {
        return view('admin.gelombang.show', [
            'mahasiswa' => $gelombang->user,
            'gelombang' => $gelombang,
            'jurusan' => Jurusan::all(),
            'pendaftar' => User::where('gelombang_id', $gelombang->id)->count(),
            'bayar' => User::whereHas('transaksi', function ($q) {
                $q->where('status', 'success');
            })->where('gelombang_id', $gelombang->id)->count(),
            'berkas' => User::whereHas('mahasiswa', function ($q) {
                $q->where('status', 'BERKAS LENGKAP');
            })->where('gelombang_id', $gelombang->id)->count(),
            'cbt' => User::whereHas('mahasiswa', function ($q) {
                $q->where('status', 'TES / CBT');
            })->where('gelombang_id', $gelombang->id)->count(),
            'interview' => User::whereHas('mahasiswa', function ($q) {
                $q->where('status', 'INTERVIEW');
            })->where('gelombang_id', $gelombang->id)->count(),
            'diterima' => User::whereHas('mahasiswa', function ($q) {
                $q->where('status', 'BERKAS DITERIIMA');
            })->where('gelombang_id', $gelombang->id)->count(),
            'keluar' => User::whereHas('mahasiswa', function ($q) {
                $q->where('status', 'KELUAR');
            })->where('gelombang_id', $gelombang->id)->count(),
            // 'perjur' => DB::table('users')
            //     ->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
            //     ->join('jurusan', 'jurusan.id', '=', 'mahasiswa.jurusan_id')
            //     ->join('gelombang', 'gelombang.id', '=', 'users.gelombang_id')
            //     ->where('users'),
        ]);
    }

    public function edit($id)
    {
        $gelombang = Gelombang::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $gelombang,
        ]);
    }

    public function destroy($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
