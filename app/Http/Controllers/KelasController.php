<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KelasController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $kelas = Kelas::latest()->get();

            return DataTables::of($kelas)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" onClick="Edit(this.id)" id="'.$data->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" onClick="Delete(this.id)" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.kelas.index');
    }

    public function store(Request $request)
    {
        Kelas::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'name' => $request->name,
            ]
        );

        return redirect()->route('admin.kelas.index')->with('success', 'data berhasil disimpan');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $kelas,
        ]);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
