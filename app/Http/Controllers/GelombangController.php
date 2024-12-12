<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Penerimaan;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
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
                    $editRoute = route('admin.gelombang.edit', $data->id);
                    $showRoute = route('admin.gelombang.show', $data->id);

                    return '
                        <a href="'.$editRoute.'" class="edit btn btn-success btn-sm">Edit</a>
                        <a href="'.$showRoute.'" class="edit btn btn-info btn-sm">Detail</a>
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

    public function show(Request $request, Gelombang $gelombang)
    {
        $search = $request->input('search');
        $query = User::where('roles', 'MAHASISWA')
            ->whereHas('mahasiswa.jurusan')
            ->where('gelombang_id', $gelombang->id)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                        ->orWhereHas('mahasiswa', function ($q) use ($search) {
                            $q->where('phone', 'like', "%$search%");
                        })
                        ->orWhereHas('lulusan', function ($q) use ($search) {
                            $q->where('asal_sekolah', 'like', "%$search%");
                        });
                });
            })
            ->when($request->filled('jurusan_id'), function ($q) use ($request) {
                $q->whereHas('mahasiswa', function ($subQuery) use ($request) {
                    $subQuery->where('jurusan_id', $request->jurusan_id);
                });
            })
            ->when($request->filled('penerimaan_id'), function ($q) use ($request) {
                $q->whereHas('mahasiswa', function ($subQuery) use ($request) {
                    $subQuery->where('penerimaan_id', $request->penerimaan_id);
                });
            });

        return view('admin.gelombang.show', [
            'mahasiswa' => $query->with(['mahasiswa.jurusan'])->get(),
            'gelombang' => $gelombang,
            'penerimaans' => Penerimaan::get(),
            'jurusans' => Jurusan::get(),
            'pendaftar' => $query->count(),
            'bayar' => $query->whereHas('transaksi', function ($q) {
                $q->where('status', 'success');
            })->count(),
            'berkas' => $query->whereHas('mahasiswa', function ($q) {
                $q->where('status', 'like', '%', 'BERKAS LENGKAP', '%');
            })->count(),
            'cbt' => $query->whereHas('mahasiswa', function ($q) {
                $q->where('status', 'like', '%', 'TES / CBT', '%');
            })->count(),
            'interview' => $query->whereHas('mahasiswa', function ($q) {
                $q->where('status', 'like', '%', 'INTERVIEW', '%');
            })->count(),
            'diterima' => $query->whereHas('mahasiswa', function ($q) {
                $q->where('status', 'like', '%', 'MAHASISWA DITERIMA', '%');
            })->count(),
            'keluar' => $query->whereHas('mahasiswa', function ($q) {
                $q->where('status', 'like', '%', 'KELUAR', '%');
            })->count(),
            'ulang' => $query->whereHas('mahasiswa', function ($q) {
                $q->where('status', 'like', '%', 'DAFTAR ULANG', '%');
            })->count(),
        ]);
    }

    public function edit($id)
    {
        $gelombang = Gelombang::with([
            'user',
            'tahun',
            'jurusan',
            'kelas',
            'penerimaan',
        ])->findOrFail($id);

        return view('admin.gelombang.edit', [
            'gelombang' => $gelombang,
            'tahuns' => Tahun::get(),
            'jurusans' => Jurusan::get(),
            'kelas' => Kelas::get(),
            'penerimaans' => Penerimaan::get(),
        ]);
    }

    public function update(Request $request)
    {
        $gelombang = Gelombang::updateOrCreate(
            ['id' => $request->id],
            [
                'nama' => $request->nama,
                'nominal' => $request->nominal,
                'status' => $request->status,
                'tahun_id' => $request->tahun_id,
            ]
        );

        // Sync relationships
        $gelombang->jurusan()->sync($request->jurusan);
        $gelombang->kelas()->sync($request->kelas);
        $gelombang->penerimaan()->sync($request->penerimaan);

        return redirect()->route('admin.gelombang.index')->with('success', 'Data berhasil diupdate');
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
