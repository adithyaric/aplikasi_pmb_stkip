<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class GelombangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $gelombang = Gelombang::latest()->get();
            return DataTables::of($gelombang)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" onClick="Edit(this.id)" id="' . $data->id . '" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onClick="Delete(this.id)" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($status) {
                    if ($status->status != null) {
                        if ($status->status == "1"){
                            return "Aktif";
                        }else{
                            return "Tidak Aktif";
                        }
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.gelombang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gelombang::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'nama' => $request->nama,
                'nominal' => $request->nominal,
                'status' => $request->status
            ],
        );

        return redirect()->route('admin.gelombang.index')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gelombang  $gelombang
     * @return \Illuminate\Http\Response
     */
    public function show(Gelombang $gelombang)
    {
        $pendaftar = User::where('gelombang_id', $gelombang)->count();
        $bayar = User::whereHas('transaksi', function ($q) {
            $q->where('status', 'success');
        })->where('gelombang_id', $gelombang)->count();
        $berkas = User::whereHas('mahasiswa', function ($q) {
            $q->where('status', 'BERKAS LENGKAP');
        })->where('gelombang_id', $gelombang)->count();
        $cbt = User::whereHas('mahasiswa', function ($q) {
            $q->where('status', 'TES / CBT');
        })->where('gelombang_id', $gelombang)->count();
        $interview = User::whereHas('mahasiswa', function ($q) {
            $q->where('status', 'INTERVIEW');
        })->where('gelombang_id', $gelombang)->count();
        $diterima = User::whereHas('mahasiswa', function ($q) {
            $q->where('status', 'BERKAS DITERIIMA');
        })->where('gelombang_id', $gelombang)->count();
        // ddd();

        // $jurusan = Jurusan::all();

        // $mahasiswa = collect();

        // if ($request->jurusan_id) {
        //     $mahasiswa = User::whereHas('mahasiswa', function ($q) use ($request) {
        //         $q->where('jurusan_id', $request->jurusan_id);
        //     })->orderBy('name')->get();
        // }

        // $mahasiswa = User::with('transaksi')->where('roles', 'MAHASISWA')->with('mahasiswa', 'biodata')->latest()->get();
        // $jurusan = Jurusan::whereHas('user')->where('user.gelombang_id', $gelombang->id)->get();
        // dd($jurusan);

        return view('admin.gelombang.show', [
            'gelombang' => $gelombang->nama,
            'gelombang_id' => $gelombang->id,
            'mahasiswa' => $gelombang->user,
            'gel' => $gelombang,
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
            'perjur' => DB::table('users')
                        ->join('mahasiswa', 'users.id', '=', 'mahasiswa.user_id')
                        ->join('jurusan', 'jurusan.id', '=', 'mahasiswa.jurusan_id')
                        ->join('gelombang', 'gelombang.id', '=', 'users.gelombang_id')
                        ->where('users')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gelombang  $gelombang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        return response()->json([
            'status' => "success",
            'data' => $gelombang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gelombang  $gelombang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gelombang $gelombang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gelombang  $gelombang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->delete();
        return response()->json([
            'status' => "success"
        ]);
    }
}
