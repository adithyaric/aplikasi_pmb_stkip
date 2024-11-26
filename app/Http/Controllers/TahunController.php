<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TahunController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $tahun = Tahun::latest()->get();

            return DataTables::of($tahun)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" onClick="Edit(this.id)" id="'.$data->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($status) {
                    if ($status->status != null) {
                        if ($status->status == '1') {
                            return 'Aktif';
                        } else {
                            return 'Tidak Aktif';
                        }
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.tahun.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Tahun::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'nama' => $request->nama,
                'status' => $request->status,
            ],
        );

        return redirect()->route('admin.tahun.index')->with('success', 'data berhasil disimpan');
    }

    public function edit($id)
    {
        $tahun = Tahun::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $tahun,
        ]);
    }

    public function destroy($id)
    {
        $tahun = Tahun::findOrFail($id);
        $tahun->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
